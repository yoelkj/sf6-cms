<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;

class CommonHelper{

    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public static function slugify($text)
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
    
    public static function slugifyIntl($text) {
        
        return \Transliterator::createFromRules(
            ':: Any-Latin;'
            . ':: NFD;'
            . ':: [:Nonspacing Mark:] Remove;'
            . ':: NFC;'
            . ':: [:Punctuation:] Remove;'
            . ':: Lower();'
            . '[:Separator:] > \'-\'')->transliterate($text);

    }


    public function composeAndSendEmail($data, $name_template)
    {

        $hidden_emails = (isset($data['hidden']) && is_array($data['hidden'])) ? $data['hidden'] : [];

        if($name_template == 'mailerContact'){

            $from_mail = $_ENV['APP_CONTACT_EMAIL']; 
            $from_mail_name = $_ENV['APP_CONTACT_NAME']; 
            $data['to'] = [$_ENV['APP_CONTACT_EMAIL']];
            $arr_data = $data;

        }elseif($name_template == 'mailer_reset'){
            
            $from_mail = $_ENV['APP_CONTACT_EMAIL'];
            $from_mail_name = $_ENV['APP_CONTACT_NAME'];
            $arr_data = $data;

        }else{

            $from_mail = $_ENV['APP_CONTACT_EMAIL'];
            $from_mail_name = $_ENV['APP_CONTACT_NAME'];
            $arr_data = array(
                'obj_order' => (isset($data['obj_order']))?$data['obj_order']:null, 
                'arr_data' => (isset($data['arr_data']))?$data['arr_data']:null, 
                'title' => (isset($data['title']))?$data['title']:null, 
                'additional_message' => (isset($data['additional_message']))?$data['additional_message']:null,
                'gotoorder' => (isset($data['gotoorder']))?$data['gotoorder']:null,
                'gotoorder_button' => (isset($data['gotoorder_button']))?$data['gotoorder_button']:null,
            );
        }

        //array_push($hidden_emails, 'reservas@snve.es');
        //array_push($hidden_emails, 'direccion@snve.es');

        if($_ENV['APP_CONTACT_TEST_EMAIL']) array_push($hidden_emails, $_ENV['APP_CONTACT_TEST_EMAIL']);

        
        if(empty($data['to'])) $data['to'] =  ['direccion@snve.es'];

        //$data['to'] =  [$_ENV['APP_CONTACT_TEST_EMAIL']];
        //hidden_emails = ['test@snve.es', 'noche_d_verano@hotmail.com'];
        
        array_unique($hidden_emails);
        array_unique($data['to']);

        if($_ENV['APP_CONTACT_DIRECCION_EMAIL']) array_push($hidden_emails, $_ENV['APP_CONTACT_DIRECCION_EMAIL']);

        try {

            $message = (new TemplatedEmail())
                ->from(new Address($from_mail, $from_mail_name))
                ->to(...$data['to'])
                ->bcc(...$hidden_emails)
                ->subject($data['subject'])
                
                ->htmlTemplate(  ($name_template ==  'mailer_reset') ?  'reset_password/email.html.twig' : 'email/'.$name_template.'.html.twig'   )
                
                ->context($arr_data);

            $result = $this->mailer->send($message);

            return $result;



        } catch (\Exception $e) {

            //Send error message
            $id_report = uniqid();
            $data_email = [         
                'subject' => 'Bug report. '.$id_report, 
                'arr_data' => [],
                'title' => 'Bug '.$id_report.' has been registered',
                'to' => [$_ENV['APP_CONTACT_TEST_EMAIL']],
                'gotoorder' => '',
                'additional_message' => '
                    <p>Se ha reportado un error en XEVENTS al generar el pedido: '.$name_template.'<br> Mensage: <br>'.$e->getMessage().'</p>',
            ];
            $this->composeAndSendDeveloperEmail( $data_email, 'mailer' );

        }
        


    }

    public function composeAndSendDeveloperEmail($data, $name_template)
    {

        $from_mail = $_ENV['APP_CONTACT_EMAIL'];
        $from_mail_name = $_ENV['APP_CONTACT_NAME'];
        $arr_data = array(
            'title' => (isset($data['title']))?$data['title']:null, 
            'additional_message' => (isset($data['additional_message']))?$data['additional_message']:null,

            'obj_order' => null, 
            'arr_data' => null, 
            'gotoorder' => null,
            'gotoorder_button' => null,
        );
        
        try {

            $message = (new TemplatedEmail())
                ->from(new Address($from_mail, $from_mail_name))
                ->to(...$data['to'])
                ->subject($data['subject'])
                ->htmlTemplate( 'email/'.$name_template.'.html.twig'   )
                ->context($arr_data);

            $result = $this->mailer->send($message);

            return $result;

        } catch (\Exception $e) {
            return false;
        }

    }


}