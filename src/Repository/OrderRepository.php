<?php

namespace App\Repository;

use App\Entity\Order;
use App\Entity\OrderDetail;
use App\Entity\OrderPayment;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Component\Security\Core\Security;

use Symfony\Component\HttpFoundation\Session\Session;

use App\Service\CommonHelper;
use DateTimeImmutable;

/**
 * @extends ServiceEntityRepository<Order>
 *
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{

    private $session;
    private Security $security;

    private CommonHelper $commonHelper;

    static public $arr_payment_method = array(
        1 => array('id' => 1, 'name' => 'SOLO PEDIDO', 'shortname' => 'onlyorder'),
        2 => array('id' => 2, 'name' => 'PAYPAL', 'shortname' => 'paypal'),
        3 => array('id' => 3, 'name' => 'TARJETA DE CREDITO', 'shortname' => 'creditcard'),
        4 => array('id' => 4, 'name' => 'TRANSFERENCIA BANCARIA', 'shortname' => 'transferencia'),
        5 => array('id' => 5, 'name' => 'EFECTIVO Y RECOGER', 'shortname' => 'efectivore')
    );

    static public $order_status = array(
        1 => array('id' => 1, 'name' => 'POR CONFIRMAR', 'shortname' => 'PORCONFIRMAR', 'class_button' => 'btn-secondary'), //FOR EDITABLE
        6 => array('id' => 6, 'name' => 'CANCELADO', 'shortname' => 'cancelado', 'class_button' => 'btn-danger'), //ANULADO - NO-STOCK
        2 => array('id' => 2, 'name' => 'CONFIRMADO', 'shortname' => 'cerrado', 'class_button' => 'btn-dark'),
        //4 => array('id' => 4, 'name' => 'CONFIRMADO', 'shortname' => 'confirmado', 'class_button' => 'btn-primary'),
        5 => array('id' => 5, 'name' => 'COMPLETADO', 'shortname' => 'completado', 'class_button' => 'btn-success'),
        //3 => array('id' => 3, 'name' => 'POR CONFIRMAR', 'shortname' => 'porconfirmar', 'class_button' => 'btn-info')
    );


    public function __construct(ManagerRegistry $registry, Security $security, CommonHelper $commonHelper)
    {
        $this->session = new Session;
        $this->security = $security;
        $this->commonHelper = $commonHelper;
        parent::__construct($registry, Order::class);
    }

    public function getPaymentMethods()
    {
        return self::$arr_payment_method;
    }

    public function getOrderStatus()
    {
        return self::$order_status;
    }

    public function generateOrder($form_data = null)
    {

        $data = $this->session->get('cart');

        $logged_user = $this->security->getUser();

        $obj_new_order = new Order();
        $obj_new_order->setUser($logged_user);

        $obj_new_order->setDateDoc(new \DateTime("now"));
        $obj_new_order->setCurrency($data['head']['currency']);
        $obj_new_order->setIsActive(1);

        $obj_new_order->setTotal($form_data['total']);

        $obj_new_order->setStatus(1);

        $this->_em->persist($obj_new_order);
        $flush_order = $this->_em->flush();

        foreach ($data['detail'] as $row_d) {

            if ($row_d['product_id']) {

                $obj_product = $this->_em->getRepository(Product::class)->find($row_d['product_id']);

                $obj_new_order_detail = new OrderDetail();
                $obj_new_order_detail->setOrderHead($obj_new_order);
                $obj_new_order_detail->setAmount(isset($row_d['items']) && $row_d['items'] ? $row_d['items'] : null);
                $obj_new_order_detail->setPrice(isset($row_d['price']) && $row_d['price'] ? $row_d['price'] : null);

                $obj_new_order_detail->setProduct($obj_product);
                $this->_em->persist($obj_new_order_detail);
                $flush = $this->_em->flush();
            }
        }

        return $obj_new_order; //return snve event to payment procces
    }

    public function acceptandsend($order = null, $payment_method = null, $autorization_code = null, $status_payment = null, $status = null, $total = null, $app_company_field = null)
    {

        $obj_order = $this->find($order);

        $result_message = null;

        //$payment_detail = $em->getRepository('BackendBundle:Order')->getPaymentDetail($order);

        if ($obj_order && $obj_order->getStatus() != 5) {

            $obj_new_order_payment = new OrderPayment();
            $obj_new_order_payment->setOrderHead($obj_order);
            $obj_new_order_payment->setPaymentMethod(3);
            $obj_new_order_payment->setPaymentCode($autorization_code);
            $obj_new_order_payment->setStatus(1);
            $obj_new_order_payment->setTotal(($total) ? number_format($total, 2, '.', '') : 0);
            $obj_new_order_payment->setIsActive(1);
            $obj_new_order_payment->setCreatedAt(new DateTimeImmutable('now'));
            $this->_em->persist($obj_new_order_payment);
            $this->_em->flush();

            if ($total) $obj_order->setTotal(($total) ? number_format($total, 2, '.', '') : 0);

            $obj_order->setStatus($status);
            $obj_order->setPaymentMethod($payment_method);

            $arr_order_data = $this->getOrderActiveView($obj_order, 1);

            //Save order
            $this->_em->persist($obj_order);
            $flush = $this->_em->flush();

            ///  ---------------------- SENDING EMAIl  ----------------------
            if ($flush == null) {

                //SEND MESSAGE
                $arr_order_status = $this->getOrderStatus();
                $label_status = $arr_order_status[$status]['name'];

                //-----------------------------------------ORDER EMAILS---------------------------------------------------------------
                $arr_recipients = $arr_emails = $arr_hidden_emails = array();

                /*
              if($obj_order->getUser()){
                $obj_user_order = $obj_order->getUser();
                if($obj_user_order && $obj_user_order->getEmail()) array_push($arr_emails, $obj_user_order->getEmail());                
              }

              if($obj_order->getUserAgency()){
                $obj_user_agency_order = $obj_order->getUserAgency();
                if($obj_user_agency_order && $obj_user_agency_order->getEmail()) array_push($arr_emails, $obj_user_agency_order->getEmail());
              }

              $obj_agency_order = $obj_order->getAgency();
              if($obj_agency_order && $obj_agency_order->getEmail()) array_push($arr_hidden_emails, $obj_agency_order->getEmail());
              */

                $obj_customer_order = $obj_order->getUser();
                $obj_supplier_order = $obj_too_order = null;
                $user_type = 'user';

                //-> email para CLIENTE su contacto AGENCIA
                //-> email para AGENCIA su contacto CLIENTE
                //-> email para TOO su contacto AGENCIA

                //Final customer
                $arr_recipients[0]['to'] = ($obj_customer_order && $obj_customer_order->getEmail()) ? $obj_customer_order->getEmail() : null;
                $arr_recipients[0]['contact_type'] = 'agency';
                $arr_recipients[0]['mask_type'] = 'final';
                $arr_recipients[0]['from'] = ($obj_supplier_order) ? $obj_supplier_order : null;
                $arr_recipients[0]['contact'] = ($obj_supplier_order) ? $obj_supplier_order : null;

                //COESA
                $arr_recipients[3]['to'] = $_ENV['APP_CONTACT_RESERVAS_EMAIL'];
                $arr_recipients[3]['contact_type'] = 'coesa';
                $arr_recipients[3]['mask_type'] = 'coesa';
                $arr_recipients[3]['from'] = 'company';
                $arr_recipients[3]['contact'] = ($obj_too_order) ? $obj_too_order : null;

                if ($user_type == 'user') {

                    //Agency
                    $arr_recipients[1]['use_agent_email'] = true;
                    $arr_recipients[1]['to'] = ($obj_supplier_order && $obj_supplier_order->getEmail()) ? $obj_supplier_order->getEmail() : null;
                    $arr_recipients[1]['contact_type'] = 'user';
                    $arr_recipients[1]['mask_type'] = 'parent';
                    $arr_recipients[1]['from'] = ($obj_supplier_order) ? $obj_supplier_order : null;
                    $arr_recipients[1]['contact'] = ($obj_customer_order) ? $obj_customer_order : null;

                    //TOO
                    $arr_recipients[2]['to'] = ($obj_too_order && $obj_too_order->getEmail()) ? $obj_too_order->getEmail() : null;
                    $arr_recipients[2]['contact_type'] = 'agency';
                    $arr_recipients[2]['mask_type'] = 'base';
                    $arr_recipients[2]['from'] = 'company';
                    $arr_recipients[2]['contact'] = ($obj_supplier_order) ? $obj_supplier_order : null;
                }

                if ($user_type == 'agency') {
                    //TOO
                    $arr_recipients[2]['use_agent_email'] = true;
                    $arr_recipients[2]['to'] = ($obj_too_order && $obj_too_order->getEmail()) ? $obj_too_order->getEmail() : null;
                    $arr_recipients[2]['contact_type'] = 'agency';
                    $arr_recipients[2]['mask_type'] = 'base';
                    $arr_recipients[2]['from'] = 'company';
                    $arr_recipients[2]['contact'] = ($obj_supplier_order) ? $obj_supplier_order : null;
                }

                //-----------------------------------------------------------------------------------------------------------------------

                foreach ($arr_recipients as $recipient) {

                    $arr_emails = [];

                    array_push($arr_emails, $recipient['to']);
                    //Add agente email to mailing
                    if ((isset($recipient['use_agent_email']) && $recipient['use_agent_email'])  &&  isset($arr_order_data['head']) && isset($arr_order_data['head']['agenteEmail']) && $arr_order_data['head']['agenteEmail']) array_push($arr_emails, $arr_order_data['head']['agenteEmail']);

                    $arr_order_data['recipient_data'] = $recipient;

                    $data_email = [
                        'obj_order' => $obj_order,
                        'arr_data' => $arr_order_data,
                        'subject' => 'DETALLE PEDIDO ' . 'P' . substr($app_company_field, 0, 2) . str_pad($obj_order->getId(), 8, "0", STR_PAD_LEFT),
                        'title' => (($recipient['mask_type'] == 'final') ? 'ESTADO DE TU PEDIDO : ' : 'ESTADO DE PEDIDO: ') . $label_status,
                        'to' => array_unique($arr_emails),
                        'hidden' => array_unique($arr_hidden_emails),
                        'gotoorder' => '',
                        'additional_message' => '',
                    ];

                    $result_message = $this->commonHelper->composeAndSendEmail($data_email, 'order');
                }
            }

            //if($objSalesOrder){$this->_em->getRepository('App\\Entity\\SalesOrder')->sendOrderEmail($objSalesOrder);}
            ///  ---------------------- END SENDING EMAIl  ----------------------

        }

        return $result_message;
    }

    public function getOrderActiveView($obj_order_row = null, $with_packs = false)
    {

        if (!$obj_order_row) {
            $obj_order_row = $this->findOneBy(['status' => 1, 'isActive' => 1]);
        }

        if ($obj_order_row) {


            //$logged_user = $this->security->getUser();
            $arr_status = $this->getOrderStatus();

            $arr_data = [];

            $obj_user = $obj_order_row->getUser();

            $arr_data['head']['cart'] = $obj_order_row->getId();
            $arr_data['head']['total'] = $obj_order_row->getTotal();
            $arr_data['head']['dateDoc'] = $obj_order_row->getDateDoc();

            $arr_data['head']['status'] = $obj_order_row->getStatus();
            $arr_data['head']['label_status'] = (isset($arr_status[$obj_order_row->getStatus()])) ? $arr_status[$obj_order_row->getStatus()]['name'] : $obj_order_row->getStatus();

            $arr_data['head']['currency'] = $obj_order_row->getCurrency();


            $arr_data['head']['user'] = ($obj_user) ? $obj_user->getId() : null;
            $arr_data['head']['userDetail']['name'] =  ($obj_user) ? $obj_user->getName() : null;
            $arr_data['head']['userDetail']['email'] = ($obj_user) ? $obj_user->getEmail() : null;
            $arr_data['head']['userDetail']['phone'] = ($obj_user) ? $obj_user->getPhone() : null;

            $arr_data['message'] = '';

            $objs_order_detail = $this->_em->getRepository('App\\Entity\\OrderDetail')->getRows($obj_order_row);

            //------Code parse price here.

            $arr_data['detail'] = $this->getOrderPrice($objs_order_detail);

            /*
            foreach ($objs_order_detail as $rowD) {
                $arr_data['detail'][$rowD->getComposeKey()]['id'] = $rowD->getId();
                $arr_data['detail'][$rowD->getComposeKey()]['items'] = $rowD->getAmount();
                $arr_data['detail'][$rowD->getComposeKey()]['description'] = $rowD->getDescription();
                $arr_data['detail'][$rowD->getComposeKey()]['code'] = $rowD->getComposeKey();
                $arr_data['detail'][$rowD->getComposeKey()]['price'] = $rowD->getPrice();
                }
                */
            //----END code parse here.
        } else {
            $arr_data = [];
        }

        return $arr_data;
    }

    public function getOrderPrice($public_order_detail)
    {

        $arr_detail = [];

        foreach ($public_order_detail as $rowD) {
            $obj_product = $rowD->getProduct();

            $arr_detail[$rowD->getId()]['code'] = 'detail-' . $rowD->getId();
            $arr_detail[$rowD->getId()]['id'] = $rowD->getId();
            $arr_detail[$rowD->getId()]['product'] = $obj_product;
            $arr_detail[$rowD->getId()]['product_id'] = $obj_product->getId();
            $arr_detail[$rowD->getId()]['items'] = $rowD->getAmount();

            $arr_detail[$rowD->getId()]['description'] = $obj_product->getTranslateName(); //$rowD->getDescription();
            $arr_detail[$rowD->getId()]['price'] = $rowD->getPrice();
            $arr_detail[$rowD->getId()]['base'] = $obj_product->getPrice();
            $arr_detail[$rowD->getId()]['hp'] = null;
        }

        return $arr_detail;
    }




    //    /**
    //     * @return Order[] Returns an array of Order objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('o.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Order
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
