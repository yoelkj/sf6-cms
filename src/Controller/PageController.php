<?php

namespace App\Controller;

use App\Entity\Page;
use App\Repository\BrandRepository;
use App\Repository\CompanyRepository;
use App\Repository\CountryRepository;
use App\Repository\PageRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class PageController extends AbstractController
{
    private TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    #[Route("/", name: 'app_homepage')]
    public function index(PageRepository $repo_page, CountryRepository $repo_country): Response
    {

        $obj_page = $repo_page->findOneByIsHomepage(true); //Load homepage configuration
        $obj_page = ($obj_page) ? $obj_page : $repo_page->find(1);

        if ($obj_page->getIsCatalog()) throw $this->createNotFoundException('It is not possible to use a catalog page as a home page');


        $obj_widgets = $obj_page->getWidgets();


        $countries = $repo_country->findByIsPresent(true);

        return $this->render('page/home.html.twig', [
            'obj_row' => $obj_page,
            'countries' => $countries,
            'obj_widgets' => $obj_widgets
        ]);
    }

    #[Route("/{_locale}/", name: 'app_homepage_local', requirements: ['_locale' => 'en|es'])]
    public function local(PageRepository $repo_page): Response
    {

        $obj_page = $repo_page->findOneByIsLocalHomepage(true); //Load homepage configuration
        $obj_page = ($obj_page) ? $obj_page : $repo_page->find(1);

        if ($obj_page->getIsCatalog()) throw $this->createNotFoundException('It is not possible to use a catalog page as a home page');

        $obj_widgets = $obj_page->getWidgets();

        return $this->render('page/local.html.twig', [
            'obj_widgets' => $obj_widgets
        ]);
    }

    #[Route(
        path: '/{_locale}/page/{slug}',
        name: 'app_page',
        requirements: [
            '_locale' => 'en|es',
        ],
    )]
    public function page($slug, PageRepository $repo_page): Response
    {

        $obj_row = $repo_page->getPageBySlug($slug);
        $obj_row_translation = $obj_row->getTranslation();

        $obj_widgets = $obj_row->getWidgets();

        return $this->render('page/index.html.twig', [
            'obj_row' => $obj_row,
            'obj_row_translation' => $obj_row_translation,
            'obj_widgets' => $obj_widgets
        ]);
    }

    #[Route(
        path: '/{_locale}/catalog',
        name: 'app_catalog',
        requirements: [
            '_locale' => 'en|es',
        ],
    )]
    public function catalog(Request $request, BrandRepository $repo_brand, PageRepository $repo_page, ProductRepository $repo_product): Response
    {

        $obj_qb = $repo_product->getCatalogData([], 1);
        $data = new Pagerfanta(new QueryAdapter($obj_qb));
        $data->setMaxPerPage(8);

        $arr_data['data'] = $data;

        return $this->render('page/catalog.html.twig', [
            'arr_catalog_data' => $arr_data,
            'search_params' => [],
            'filter_data' => null,
            'obj_row' => null,
            'obj_row_translation' => null,
            'obj_widgets' => null
        ]);
    }

    #[Route(
        path: '/{_locale}/product/{slug}',
        name: 'app_product',
        requirements: [
            '_locale' => 'en|es',
        ],
    )]
    public function product(Request $request, $slug, ProductRepository $repo_product): Response
    {

        $obj_row = $repo_product->getRowBySlug($slug);
        $obj_row_translation = $obj_row->getTranslation();

        $obj_widgets = $obj_row->getWidgets();

        return $this->render('page/product.html.twig', [
            'obj_row' => $obj_row,
            'obj_row_translation' => $obj_row_translation,
            'obj_widgets' => $obj_widgets,
        ]);
    }

    #[Route(
        path: '/{_locale}/ajax-catalog',
        name: 'ajax_app_products',
        requirements: [
            '_locale' => 'en|es',
        ],
    )]
    public function ajaxGetProducts(Request $request, ProductRepository $repo_product)
    {

        if ($request->isXmlHttpRequest()) {

            $params = $request->request->all();
            $obj_qb = $repo_product->getCatalogData($params, 1);
            $pager = new Pagerfanta(new QueryAdapter($obj_qb));
            $pager->setMaxPerPage(8);
            $pager->setCurrentPage((isset($params['page']) && $params['page']) ? $params['page'] : 1);

            return $this->render('page/_products.html.twig', [
                'data' => $pager
            ]);
        }
    }

    #[Route(
        path: '/{_locale}/search',
        name: 'app_search',
        requirements: [
            '_locale' => 'en|es',
        ],
    )]
    public function search(Request $request,  PageRepository $repo_page)
    {
        $params['q'] = $request->query->get('q');
        $request->getSession()->set('searchParams', $params);

        $data = $repo_page->getData($params);

        if ($request->query->get('preview')) {
            return $this->render('page/_searchPreview.html.twig', [
                'data' => $data,
            ]);
        }
    }

    /*
    
    #[Route(
        path: '/{_locale}/search',
        name: 'app_search',
        requirements: [
            '_locale' => 'en|es',
        ],
    )]
    public function search( Request $request,  ProductRepository $repo_product)
    {
        $params['q'] = $request->query->get('q'); 
        $request->getSession()->set('searchParams', $params);
        
        $products = $repo_product->getCatalogData($params);
        
        if ($request->query->get('preview')) {
            return $this->render('page/_searchPreview.html.twig', [
                'products' => $products,
            ]);
        }
    }
    
    */

    #[Route(
        path: '/{_locale}/terms-and-conditions',
        name: 'app_terms',
        requirements: [
            '_locale' => 'en|es|ch|it',
        ],
    )]
    public function termAndConditions(
        Request $request,
        CompanyRepository $repo_company
    ): Response {

        $company = $request->getSession()->get('appParam');
        $only = $request->query->get('onlydata');

        $actions = ($request->isXmlHttpRequest()) ? 1 : 0;
        $template = ($request->isXmlHttpRequest()) ? '_contentTerms.html.twig' : 'terms.html.twig';
        $obj_company = ($company) ? $repo_company->find($company->getId()) : null;

        //dd($obj_company->getTranslation());
        return $this->render('page/' . $template, [
            'onlydata' => $only,
            'company' => $obj_company,
            'company_translation' => $obj_company->getTranslation(),
            'actions' => $actions
        ]);
    }


    #[Route(
        path: '/{_locale}/proccess-form',
        name: 'app_proccess_form',
        requirements: [
            '_locale' => 'en|es',
        ],
    )]
    public function proccessForm(Request $request, MailerInterface $mailer)
    {

        $params = $request->request->all();
        $session_data = $request->getSession()->get('appParam');
        $to_email = $session_data->getEmailMain();
        $from_email = $session_data->getEmailMain();

        if (!isset($params['proccess']) || ($params['proccess'] != 'contact' && $params['proccess'] != 'subscriber')) throw $this->createNotFoundException('It is not possible send email, invalid action');

        $message_error = $this->translator->trans('Sorry we did not receive your message, please try again');

        if ($params['proccess'] == 'contact') {
            $message_success = $this->translator->trans('We have received your message, thank you for contacting us');
            $template = 'email/contact.html.twig';
        }
        if ($params['proccess'] == 'subscriber') {
            $message_success = $this->translator->trans('We have received your message, thanks for subscribing');
            $template = 'email/subscriber.html.twig';
        }

        try {
            $email = (new TemplatedEmail())
                ->from($from_email)
                ->to($to_email)
                ->subject('Contact from website')
                ->htmlTemplate($template)
                ->context([
                    'data' => $params
                ]);

            $mailer->send($email);
            $this->addFlash('success', $message_success);
        } catch (\Exception $e) {
            $this->addFlash('error', $message_error);
        }

        $referer = $request->headers->get('referer');
        return $this->redirect($referer);
    }
}
