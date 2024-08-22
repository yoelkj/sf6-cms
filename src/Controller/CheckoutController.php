<?php

namespace App\Controller;

use App\Entity\Agency;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;

use App\Service\RedsysAPI;
use Psr\Log\LoggerInterface;

use App\Entity\PaymentLog;
use App\Entity\Order;
use App\Entity\User;
use App\Repository\PaymentLogRepository;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Contracts\Translation\TranslatorInterface;

use App\Service\CommonHelper;

#[Route('/{_locale}/checkout')]
class CheckoutController extends AbstractController
{

  private $session;
  private $logger;
  private $em;
  private CommonHelper $commonHelper;

  public function __construct(LoggerInterface $logger, EntityManagerInterface $em, CommonHelper $commonHelper)
  {

    $this->session = new Session;
    $this->logger = $logger;
    $this->em = $em;
    $this->commonHelper = $commonHelper;
  }

  #[Route('/generate-public-form', name: 'app_checkout_form')]
  #[IsGranted('IS_AUTHENTICATED_FULLY')]
  public function generatePublicForm(Request $request)
  {

    //$order = $request->request->get('order');
    //$total = $request->request->get('total');

    $payment_method = $request->request->get('method_payment');
    $cardBrand = $request->request->get('card_brand');
    $cardComm = $request->request->get('card_comm');

    if ($cardBrand) {
      $html_form = '<div class="form-container">
            <div class="field-container">
                <label for="name">Name</label>
                <input id="name" name="namec" maxlength="20" type="text" autocomplete="off">
            </div>
            <div class="field-container">
                <label for="cardnumber">Card Number</label>
                <input id="cardnumber" name="cardnumber" type="text" size="19" placeholder="---- ---- ---- ----">
            </div>
            <div class="field-container">
                <label for="expirationdate">Expiration (mm/yy)</label>
                <input id="expirationdate" name="expirationdate" type="text" size="7" placeholder="-- / --">
            </div>
            <div class="field-container">
                <label for="securitycode">Security Code</label>
                <input id="securitycode" name="securitycode" type="text" size="3" placeholder="---">
            </div>
          </div>';
      $html_form .= '<div class="billing__secure-connection alert alert-info text-center"><i class="fas fa-lock"></i> <strong class="secure-text">Conexión segura</strong></div>';

      $arr_result = array("status" => 200, 'card_comm' => $cardComm, "response" => $html_form);
      return new JsonResponse($arr_result);
    } else {

      switch ($payment_method) {
        case 1:
          $arr_result = array("status" => 200, 'card_comm' => $cardComm, "response" => '');
          return new JsonResponse($arr_result);
          break;
        case 2:
          $arr_result = array("status" => 200, 'card_comm' => $cardComm, "response" => '');
          return new JsonResponse($arr_result);
          break;
      }
    }
  }


  #[Route('/main', name: 'app_checkout')]
  #[IsGranted('IS_AUTHENTICATED_FULLY')]
  public function index(Request $request, OrderRepository $repo_order, RedsysAPI $bankObj)
  {

    //, PaymentLogRepository $repo_pay_log
    //TranslatorInterface $translator, 

    $order = $request->request->get('order');
    $order_mask = $request->request->get('order_mask');
    $total = $request->request->get('total');
    $payment_method = $request->request->get('method_payment'); //Si no hay monto de pago hace el procedimiento del wallet.

    //Generate order
    if (!$order) {
      $obj_order = $this->em->getRepository(Order::class)->generateOrder($request->request->all());
      $order = $obj_order->getId();
    } else {
      $obj_order = $this->em->getRepository(Order::class)->find($order);
    }

    if ($obj_order) $this->session->set('cart', null);

    $amount = 0;
    $cardBrand = $request->request->get('card_brand');

    //Payment proccess    
    if ($payment_method == 3) {

      $num_nclose = $repo_order->getNumCloseOrder($obj_order->getId());
      $num_nclose = $num_nclose + 1;

      //Config
      $url_tpvv = $this->getParameter('url.tpv');
      $clave = $this->getParameter('clave.tpv');
      $code = $this->getParameter('code.tpv');
      $terminal = $this->getParameter('terminal.tpv');

      $order = strval($order_mask);
      $amount = number_format($total, 2, '.', '') * 100;
      $currency = '978';
      $transactionType = '0';
      $urlMerchant = $request->getSchemeAndHttpHost() . $this->generateUrl('app_checkoutbanknotify');
      $urlOK = $request->getSchemeAndHttpHost() . $this->generateUrl('app_checkoutbankreturn');
      $urlKO = $request->getSchemeAndHttpHost() . $this->generateUrl('app_checkoutbankcancel');

      $cardBrand = $cardBrand;
      $titularc = $request->request->get('namec');

      $arr_exp_date = explode('/', $request->request->get('expirationdate'));
      $expdate = ($arr_exp_date && isset($arr_exp_date[1]) && isset($arr_exp_date[0])) ? trim($arr_exp_date[1]) . trim($arr_exp_date[0]) : null;

      $panc = str_replace(' ', '', $request->request->get('cardnumber'));
      $cvvnb = $request->request->get('securitycode');

      //-----------Save order payment method
      //$query = $this->em->createQuery('DELETE  App\\Entity\\PaymentLog php WHERE php.orderpay = :orderpay')->setParameter("orderpay", $obj_order);
      //$query->execute();

      /*
      $repo_pay_log->activateToggle($obj_order, 0);
      $orderPaymentAdd = new PaymentLog();
      $orderPaymentAdd->setOrderpay($obj_order);
      $orderPaymentAdd->setTransactionId($obj_order->getId());
      $orderPaymentAdd->setIsWallet(false);
      $orderPaymentAdd->setAmount(number_format($total, 2, '.', ''));
      $orderPaymentAdd->setUserType('user');
      $orderPaymentAdd->setUser($this->getUser());
      $orderPaymentAdd->setPaymentMode('card');
      $this->em->persist($orderPaymentAdd);
      $this->em->flush();
      */

      //--------END---Save order payment method

      //Save order
      $obj_order->setNclose($num_nclose);
      $this->em->persist($obj_order);
      $this->em->flush();

      //$bankObj = $this->get("app.redsys");//new RedsysAPI;

      $bankObj->setParameter("DS_MERCHANT_MERCHANTNAME", "SN V&E PLATAFORMA INTERNACIONAL, SL");
      $bankObj->setParameter("DS_MERCHANT_AMOUNT", $amount);
      $bankObj->setParameter("DS_MERCHANT_CURRENCY", $currency);
      $bankObj->setParameter("DS_MERCHANT_ORDER", $order . '-' . $num_nclose);
      $bankObj->setParameter("DS_MERCHANT_MERCHANTCODE", $code);
      $bankObj->setParameter("DS_MERCHANT_TERMINAL", $terminal);
      $bankObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE", $transactionType);
      $bankObj->setParameter("DS_MERCHANT_MERCHANTURL", $urlMerchant);
      $bankObj->setParameter("DS_MERCHANT_URLOK", $urlOK);
      $bankObj->setParameter("DS_MERCHANT_URLKO", $urlKO);
      $bankObj->setParameter("Ds_Merchant_Titular", $titularc);
      $bankObj->setParameter("Ds_Merchant_Pan", $panc);
      $bankObj->setParameter("Ds_Merchant_ExpiryDate", $expdate);
      $bankObj->setParameter("Ds_Merchant_CVV2", $cvvnb);
      $bankObj->setParameter("Ds_Card_Brand", $cardBrand);

      $params = $bankObj->createMerchantParameters();
      $signature = $bankObj->createMerchantSignature($clave);

      $bankData = [];
      $bankData["Ds_SignatureVersion"] = "HMAC_SHA256_V1";
      $bankData["Ds_MerchantParameters"] = $params;
      $bankData["Ds_Signature"] = $signature;
      $bankData["host"] = $url_tpvv;

      $html_form = '<form id="makePayment" action="' . $bankData["host"] . '" method="post">';
      $html_form .= '<input type="hidden" name="Ds_SignatureVersion" value="' . $bankData["Ds_SignatureVersion"] . '">';
      $html_form .= '<input type="hidden" name="Ds_MerchantParameters" value="' . $bankData["Ds_MerchantParameters"] . '">';
      $html_form .= '<input type="hidden" name="Ds_Signature" value="' . $bankData["Ds_Signature"] . '">';
      //$html_form .= '<input class="btn btn-success float-right" type="submit" name="submitPayment" value="PAGO SEGURO CON TARJETA">';
      $html_form .= '</form>';

      $arr_result = array("status" => 200, "response" => $html_form);
      return new JsonResponse($arr_result);
    } else {

      if ((int)$payment_method == 1 || (int)$payment_method == 2) {

        //$response = AppOrder::acceptandsend($order, $payment_method, null, null, 3, $total);

        try {

          $agency_manager = null;

          $this->em->getRepository(Order::class)->acceptAndSend($order, $payment_method, null, null, 3, $total, strtoupper($this->getParameter('app_company')));

          $obj_user = $this->getUser();

          if ($obj_user instanceof Agency) {
            if ($obj_user->isIsSuperuser()) {
              $agency_manager = 'Esencial Tours';
            } else {
              $obj_agency_manager = $this->em->getRepository(Agency::class)->getSuperUser($obj_user->getCustomer());
            }
          }

          if ($obj_user instanceof User) {
            $obj_agency_manager = $obj_order->getAgency();
          }

          $agency_manager = (isset($obj_agency_manager) && $obj_agency_manager) ? $obj_agency_manager->getName() . ' ' . $obj_agency_manager->getLastname() : $agency_manager;

          /* 
          Te recordamos que estás pidiendo una reserva pero aún no está confirmada. 
                Tu AAVV (aquí sería genial que saliera la AAVV en la que ha hecho la reserva para personalizarlo más) se pondrá en contacto contigo (esto para cliente final). 
                Tu TTOO (aquí sería genial que saliera el nombre del TTOO del que cuelga, para personalizarlo un poco) se pondrá en contacto contigo (esto para AAVV). 
                Esencial Tours se pondrá en contacto contigo (esto para el TTOO).`;
          */

          switch ($request->getLocale()) {
            case 'es':
              $susses_message = ($agency_manager) ? 'Su pedido se ha completado correctamente. Te recordamos que estás pidiendo una reserva pero aún no está confirmada. ' . $agency_manager . ' se pondrá en contacto contigo.' : 'Su pedido se ha completado correctamente.';
              break;

            default:
              $susses_message = ($agency_manager) ? 'Your order has been successfully completed. We remind you that you are requesting a reservation but it is not yet confirmed. ' . $agency_manager . '. will contact you' : 'Your order has been successfully completed.';
              break;
          }

          $this->session->getFlashBag()->add('success', $susses_message);
        } catch (\Exception $e) {

          switch ($request->getLocale()) {

            case 'es':
              $error_message = 'Hubo un problema al generar el pedido, inténtalo nuevamente.';
              break;

            default:
              $error_message = 'There was a problem generating the order, please try again.';
              break;
          }

          //Send error message
          $id_report = uniqid();
          $data_email = [
            'subject' => 'Bug report. ' . $id_report,
            'arr_data' => [],
            'title' => 'Bug ' . $id_report . ' has been registered',
            'to' => [$_ENV['APP_CONTACT_TEST_EMAIL']],
            'gotoorder' => '',
            'additional_message' => '
                  <p>Se ha reportado un error en XEVENTS al generar el pedido: ' . $order . '<br> Mensage: <br>' . $e->getMessage() . '</p>',
          ];
          $this->commonHelper->composeAndSendDeveloperEmail($data_email, 'mailer');

          $this->session->getFlashBag()->add('error', $error_message);
        }

        exit;
      }
    }
  }

  /**
   * @Route("/bank-notify", name="app_checkoutbanknotify")
   */
  public function banknotifyAction(Request $request)
  {

    $bankObj = new RedsysAPI;

    $this->logger->info('Verified BANK notify: TEST');

    $clave = $this->getParameter('clave.tpv');

    //$version = $_POST['Ds_SignatureVersion'];
    $params = $_POST['Ds_MerchantParameters'];
    $signatureRequest = $_POST['Ds_Signature'];

    $signatureCalcule = $bankObj->createMerchantSignatureNotif($clave, $params);
    $decodec = $bankObj->decodeMerchantParameters($params);

    $obj_params = json_decode($decodec);
    $order = $obj_params->Ds_Order;
    $response = $obj_params->Ds_Response;
    $ds_amount = $obj_params->Ds_Amount;
    $authorisation_code = $obj_params->Ds_AuthorisationCode;

    //['Ds_Amount'];['Ds_Order'];['Ds_MerchantCode'];['Ds_Currency'];['Ds_Response'];['Ds_Signature'];['Ds_AuthorisationCode'];


    $this->logger->info('Verified BANK notify DATA ' . json_encode($obj_params));

    if ($signatureRequest === $signatureCalcule) {


      $order = explode('-', $order);
      $order = (int)$order[1];

      if ((int) $response < 100) {

        $this->em->getRepository(Order::class)->acceptAndSend($order, 3, $authorisation_code, (int)$response, 5, $ds_amount);
      }

      $this->logger->info('Verified BANK SIGN: found ' . $order);
    } else {

      $this->logger->info('Verified BANK SIGN: not found ' . $order);
    }

    exit;
  }

  /**
   * @Route("/bank-cancel", name="app_checkoutbankcancel")
   */
  public function bankcancelAction(Request $request)
  {
    $this->session->getFlashBag()->add('error', 'REGISTRO NO ACTUALIZADO INTENTELO NUEVAMENTE');
    return $this->redirectToRoute('app_order');
  }

  /**
   * @Route("/bank-return", name="app_checkoutbankreturn")
   */
  public function bankreturnAction(Request $request)
  {
    $this->session->set('app_cart', null);
    $this->session->getFlashBag()->add('success', 'SU PROCESO SE HA COMPLETADO CORRECTAMENTE');
    return $this->redirectToRoute('app_order');
  }
}
