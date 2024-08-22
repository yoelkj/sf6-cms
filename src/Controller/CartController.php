<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;

class CartController extends AbstractController
{

    #[Route(path: '/{_locale}/app/cart', name: 'app_cart')]
    public function index(Request $request, OrderRepository $order_repo): Response
    {
        $obj_user = $this->getUser();
        //$is_admin = $this->isGranted('ROLE_ADMIN');

        $page = $request->query->get('page', 1);

        //--------------------------------DEFAULT PARAMS------------------------------------------------------------------
        if ($request->isMethod('post')) {
            $request_params = $request->request->all();
            if (isset($request_params['btn-clear']) && $request_params['btn-clear'] == 'clear') {
                $request->getSession()->set('filterData', []);
                $request_params = [];

                $page = 1;
            }

            if (isset($request_params['btn-submit']) && $request_params['btn-submit'] == 'submit') {
                $request->getSession()->set('filterData', []);
                $request->getSession()->set('filterData', ['order' => $request_params]);

                $page = 1;
            }
        }
        //--------------------------------DEFAULT PARAMS------------------------------------------------------------------

        $request_params = ($request->getSession()->get('filterData')) ? $request->getSession()->get('filterData') : [];

        $rows = $order_repo->getRows($obj_user, (isset($request_params['order'])) ? $request_params['order'] : []);
        $pager = new Pagerfanta(new QueryAdapter($rows));
        $pager->setMaxPerPage(10);
        $pager->setCurrentPage($page);

        return $this->render('cart/index.html.twig', [
            'rows' => $pager,
            //'is_admin' => $is_admin,
            'arr_status' => $order_repo->getOrderStatus()
        ]);
    }

    #[Route('/{_locale}/app/ajax-user-add-cart', name: 'app_ajax_user_save_cart')]
    public function ajaxUserSaveMargenAction(
        Request $request,
        OrderRepository $repo_order
    ) {
        if ($request->isXmlHttpRequest()) {

            //$request->getSession()->set('cart', null);

            //get session order data
            $arr_data = ($request->getSession()->get('cart')) ? $request->getSession()->get('cart') : [];

            //Params
            $request_params = $request->request->all();

            $cart_id = (isset($request_params['cartid'])) ? $request_params['cartid'] : null;

            $price = (isset($request_params['price'])) ? $request_params['price'] : null;
            $pricemask = (isset($request_params['pricemask'])) ? $request_params['pricemask'] : null;

            $currency = (isset($request_params['currency'])) ? $request_params['currency'] : null;
            $items = (isset($request_params['items'])) ? $request_params['items'] : null;

            $product_code = (isset($request_params['product'])) ? $request_params['product'] : null;
            $description = (isset($request_params['description'])) ? $request_params['description'] : null;
            $code = (isset($request_params['code'])) ? $request_params['code'] : null;

            $logued_user = ($this->getUser()) ? $this->getUser()->getId() : null;

            $arr_prod_code = explode('-', $product_code);

            $product_id = (isset($arr_prod_code[1]) && $arr_prod_code[1]) ? $arr_prod_code[1] : '';

            //Clear session message
            if (isset($arr_data['message'])) $arr_data['message'] = '';

            //Fill data
            if (!isset($arr_data['head'])) {
                $arr_data['message'] = '';
                $arr_data['head']['cart'] = $cart_id;
                $arr_data['head']['user'] = $logued_user;
                $arr_data['head']['currency'] = $currency;
            }

            if (isset($arr_data['detail'][$code])) {
                $arr_data['detail'][$code]['items'] += ($items) ? $items : 1;
                $arr_data['detail'][$code]['currency'] = $currency;
            } else {

                $arr_data['detail'][$code]['code'] = $code;
                $arr_data['detail'][$code]['product_id'] = $product_id;
                $arr_data['detail'][$code]['description'] = $description;
                $arr_data['detail'][$code]['items'] = ($items) ? $items : 1;
                $arr_data['detail'][$code]['price'] = $price;
                $arr_data['detail'][$code]['currency'] = $currency;
                $arr_data['detail'][$code]['pricemask'] = $pricemask;
            }

            $request->getSession()->set('cart', $arr_data);

            //Count cart elements
            $counter = 0;
            if (isset($arr_data['detail'])) foreach ($arr_data['detail'] as $keyd => $rowd) $counter += $rowd['items'];

            return $this->json(['data' => $arr_data['detail'][$code], 'counter' => $counter], 200, []);
        }
    }

    #[Route(
        path: '/{_locale}/ajax-cart-detail',
        name: 'ajax_app_cart_detail',
        requirements: [
            '_locale' => 'en|es|ch|it',
        ],
    )]
    public function ajaxGetCartDetail(Request $request)
    {

        if ($request->isXmlHttpRequest()) {

            return $this->render('cart/_cartDetail.html.twig', [
                'data' => $request->getSession()->get('cart'),
                'useActions' => true,
                'catalog_uri' => 'app_homepage_local'
            ]);
        }
    }


    #[Route(
        path: '/{_locale}/app-cart-show',
        name: 'app_cart_show',
        requirements: [
            '_locale' => 'en|es|ch|it',
        ],
    )]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function cartShow(
        Request $request,
    ) {

        $default_payment_method = 1; //$repo_pay_type->find(1);
        $catalog_uri = 'app_homepage_local';

        $arr_data = $request->getSession()->get('cart');


        return $this->render('cart/show.html.twig', [
            'data' => $arr_data,
            'catalog_uri' => $catalog_uri,
            'obj_payment_methods' => null, //$obj_payment_methods = $repo_pay_type->getPaymentTypes(['isActive' => 1, 'cardBrand' => 1], ['id'=>'ASC']);
            'default_payment_method' => $default_payment_method
        ]);
    }

    #[Route(
        path: '/{_locale}/app-order-show/{id}',
        name: 'app_order_show',
        requirements: [
            '_locale' => 'en|es|ch|it',
        ],
    )]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function orderShow(Request $request, $id, OrderRepository $repo_order)
    {

        //$obj_user = $this->getUser();

        $obj_order = ($id) ? $repo_order->find($id) : null;
        $arr_order_data = ($obj_order) ? $repo_order->getOrderActiveView($obj_order, 1) : null;

        return $this->render('cart/orderShow.html.twig', [
            'arr_data' => $arr_order_data,
            'arr_status' => $repo_order->getOrderStatus()
            //'is_admin' => $this->isGranted('ROLE_ADMIN')
        ]);
    }

    #[Route(
        path: '/{_locale}/app_cart_delete_item',
        name: 'app_cart_delete_item',
        requirements: [
            '_locale' => 'en|es|ch|it',
        ],
    )]
    public function ajaxRemoveCartItem(Request $request)
    {
        if ($request->isXmlHttpRequest()) {

            $arr_cart = $request->getSession()->get('cart');
            $params = $request->request->all();


            //$params['code'];
            if ($params['code'] && isset($arr_cart['detail'][$params['code']])) {
                unset($arr_cart['detail'][$params['code']]);
            }

            $request->getSession()->set('cart', $arr_cart);

            $arr_result = [];

            return $this->json($arr_result, 200, []);
        }
    }
}