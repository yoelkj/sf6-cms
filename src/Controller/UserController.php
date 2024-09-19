<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderPayment;
use App\Repository\OrderRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;

use App\Service\OpenpayService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class UserController extends BaseController
{

    private OpenpayService $openpayService;
    private $session;

    public function __construct(private EntityManagerInterface $em, OpenpayService $openpayService)
    {

        $this->openpayService = $openpayService;
        $this->em = $em;
        $this->session = new Session();
    }

    #[Route('/{_locale}/user/profile', name: 'app_user_profile')]
    #[IsGranted('IS_AUTHENTICATED_REMEMBERED')]
    public function index(Request $request, OrderRepository $repo_order): Response
    {
        //Get and update payment data
        $request_params_id_transac = $request->query->get('id');;
        if (isset($request_params_id_transac) && strlen($request_params_id_transac) > 19) {

            try {
                $selected_charge = $this->openpayService->getTransaction(strip_tags($request_params_id_transac));

                if ($selected_charge->status === 'completed') {
                    $ser_data = $selected_charge->serializableData;
                    if (isset($ser_data['order_id'])) {

                        $arr_order_d = explode('-', $ser_data['order_id']);
                        $ser_order_id = (isset($arr_order_d[1])) ? (int)$arr_order_d[1] : null;

                        if ($ser_order_id) {
                            //generate payment information
                            $this->em->getRepository(Order::class)->acceptAndSend($ser_order_id, 3, $request_params_id_transac, $request_params_id_transac, 5, $ser_data['amount'], strtoupper($this->getParameter('app_company')));
                            $this->session->getFlashBag()->add('success', 'Order completed successfully');
                        } else {
                            $this->session->getFlashBag()->add('warning', 'Order completed successfully');
                        }
                    }
                } else {

                    $this->session->getFlashBag()->add('error', 'The order has not been completed, please contact the administrator');
                }
            } catch (\Exception $e) {
                $this->session->getFlashBag()->add('error', 'The order has not been completed, please contact the administrator');
            }
        }

        //Return order
        return $this->render('user/profile.html.twig', [
            'arr_status' => $repo_order->getOrderStatus()
        ]);
    }

    #[Route('/api/me', name: 'app_ajax_user_detail')]
    #[IsGranted('IS_AUTHENTICATED_REMEMBERED')]
    public function apiMe(): Response
    {

        /*
        $this->denyAccessUnlessGranted('ROLE_USER');
        if ($question->getOwner() !== $this->getUser()) {
            throw $this->createAccessDeniedException('You are not the owner!');
        }
        */

        //$this->denyAccessUnlessGranted('SHOW', $this->getUser());

        return $this->json($this->getUser(), 200, [], [
            'groups' => ['user:read']
        ]);
    }
}
