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
use App\Service\OpenpayService;
use Exception;
use Symfony\Component\HttpFoundation\Response;

#[Route('/{_locale}/checkout')]
class CheckoutController extends AbstractController
{

  private $session;
  private $logger;
  private $em;
  private CommonHelper $commonHelper;
  private OpenpayService $openpayService;

  public function __construct(
    LoggerInterface $logger,
    EntityManagerInterface $em,
    CommonHelper $commonHelper,
    OpenpayService $openpayService
  ) {

    $this->session = new Session;
    $this->logger = $logger;
    $this->em = $em;
    $this->commonHelper = $commonHelper;

    $this->openpayService = $openpayService;
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

      $arr_result = array("status" => 200, 'card_comm' => $cardComm, "response" => '');
      return new JsonResponse($arr_result);

      /*
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
            */
    }
  }

  #[Route('/main', name: 'app_checkout')]
  #[IsGranted('IS_AUTHENTICATED_FULLY')]
  public function index(Request $request, OrderRepository $repo_order, RedsysAPI $bankObj)
  {

    //, PaymentLogRepository $repo_pay_log
    //TranslatorInterface $translator, 

    $obj_user = $this->getUser();
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

    //Payment proccess    
    if ($payment_method == 3) {

      //$order = strval($order_mask);
      //$order = (!$order) ? $obj_order->getId() : $order;

      $nclose = (int) $obj_order->getNclose() + 1;

      $order_mask = 'P' . substr($_ENV['APP_COMPANY'], 0, 2) . '-' . str_pad($order, 8, 0, STR_PAD_LEFT);
      $amount = number_format($total, 2, '.', '');
      $currency = 'PEN';
      $description = 'Payment - ' . $order_mask;
      $orderId = $order_mask . '-' . $nclose;

      // Datos del cliente
      $customerData = [
        'name' => $obj_user->getName(),
        'email' => $obj_user->getEmail(),
        'phone' => $obj_user->getPhone(),
        //'address_line1' => 'Av. Reforma 123',
        //'postal_code' => '0101',
        //'city' => 'LIMA',
        //'state' => 'LIMA',
        //'country_code' => 'PE',
      ];

      //$amount = number_format($total, 2, '.', '') * 100;

      //dd($amount, $currency, $description, $orderId, $customerData);

      $charge = $this->openpayService->createCheckout($amount, $currency, $description, $orderId, $customerData);

      if ($charge && isset($charge->payment_method->url)) {

        //Save generate payment intent
        $obj_order->setNclose($nclose);
        $this->em->persist($obj_order);
        $this->em->flush();

        //return data to redirect payment screeem
        return $this->json(['access_payment_form' => true, 'url' => $charge->payment_method->url, 'order_id' => $obj_order->getId()]);
      } else {
        $this->session->getFlashBag()->add('error', 'El pago no ha sido procesado');
      }

      return $this->json(['error' => 'No se pudo generar la URL de pago'], Response::HTTP_BAD_REQUEST);
    } else {

      if ((int)$payment_method == 1 || (int)$payment_method == 2) {

        try {

          $this->em->getRepository(Order::class)->acceptAndSend($order, $payment_method, null, null, 1, $total, strtoupper($this->getParameter('app_company')));

          switch ($request->getLocale()) {
            case 'es':
              $susses_message = 'Su pedido se ha completado correctamente.';
              break;

            default:
              $susses_message = 'Your order has been successfully completed.';
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
                  <p>Se ha reportado un error en COESA al generar el pedido: ' . $order . '<br> Mensage: <br>' . $e->getMessage() . '</p>',
          ];
          $this->commonHelper->composeAndSendDeveloperEmail($data_email, 'mailer');

          $this->session->getFlashBag()->add('error', $error_message);
        }

        exit;
      }
    }
  }

  /**
   * @Route("/webhook/openpay-bank-notify", name="webhook_openpay_bank_notify", methods={"POST"})
   */
  public function banknotifyAction(Request $request, LoggerInterface $logger): Response
  {
    // Lee el contenido del webhook enviado por Openpay
    $content = json_decode($request->getContent(), true);

    // Log para depuración (opcional)
    $logger->info('Webhook recibido', $content);

    // Validar el evento (ejemplo con "charge.succeeded")
    if ($content['type'] === 'charge.succeeded') {
      // Obtener información del pedido
      $transactionId = $content['transaction']['id'];
      $orderId = $content['transaction']['order_id'];
      $amount = $content['transaction']['amount'];

      $order = explode('-', $orderId);
      $order = (int)$order[1];
      $this->em->getRepository(Order::class)->acceptAndSend($order, 3, $transactionId, $transactionId, 5, $amount, strtoupper($this->getParameter('app_company')));

      // Responde a Openpay con un 200 para confirmar que recibiste el webhook
      return new Response('OK', Response::HTTP_OK);
    }

    // Si el evento no es relevante, responde con un 200
    return new Response('Event not handled', Response::HTTP_OK);
  }

  /**
   * @Route("/openpay-bank-cancel", name="webhook_openpay_bank_cancel")
   */
  public function bankcancelAction(Request $request)
  {
    $this->session->getFlashBag()->add('error', 'REGISTRO NO ACTUALIZADO INTENTELO NUEVAMENTE');
    return $this->redirectToRoute('app_order');
  }

  /**
   * @Route("/openpay-bank-return", name="webhook_openpay_bank_return")
   */
  public function bankreturnAction(Request $request)
  {
    $this->session->set('app_cart', null);
    $this->session->getFlashBag()->add('success', 'SU PROCESO SE HA COMPLETADO CORRECTAMENTE');
    return $this->redirectToRoute('app_order');
  }
}
