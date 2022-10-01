<?php

namespace App\Controller\Admin;

use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Company;
use App\Entity\Country;
use App\Entity\Gallery;
use App\Entity\GalleryImages;
use App\Entity\Language;
use App\Entity\Menu;
use App\Entity\Office;
use App\Entity\Page;
use App\Entity\Presentation;
use App\Entity\Product;
use App\Entity\User;
use App\Entity\Widget;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;

use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;


class DashboardController extends AbstractDashboardController
{
    /*
    private ChartBuilderInterface $chartBuilder;

    public function __construct(ChartBuilderInterface $chartBuilder)
    {
        $this->chartBuilder = $chartBuilder;
    }
    */

    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{_locale}/admin', name: 'admin', requirements: ['_locale' => 'en|es|pe|bo',],)]
    //public function index(ChartBuilderInterface $chartBuilder = null): Response
    public function index(): Response
    {

        //assert(null !== $chartBuilder);

        //return parent::index();

        // Redirect to some common page of your backend
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(PageCrudController::class)->generateUrl());


        // redirect to different pages depending on the user
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }
        
        /*
        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart->setData([
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            'datasets' => [
                [
                    'label' => 'Potions Brewed',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'data' => [0, 10, 5, 2, 20, 30, 45],
                ],
                [
                    'label' => 'Frogs Created',
                    'backgroundColor' => 'rgb(86, 217, 0)',
                    'data' => [40, 25, 55, 32, 22, 10, 6],
                ],
            ],
        ]);

        $chart2 = $chartBuilder->createChart(Chart::TYPE_PIE);
        $chart2->setData([
            'labels' => ['Self-Vanishing', 'Miniaturization', 'Clown Feet', 'Poor Musical Taste'],
            'datasets' => [
                [
                    'label' => 'Accidents',
                    'data' => [40, 66, 110, 20],
                    'backgroundColor' => [
                      'rgb(255, 99, 132)',
                      'rgb(54, 162, 235)',
                      'rgb(255, 205, 86)'
                    ],
                    'hoverOffset' => 4,
                ],
            ],
        ]);

        return $this->render('admin/dashboard/index.html.twig', [
            //'chart' => $this->createChart($chartBuilder),
            'chart2' => $chart,
            'chart3' => $chart2,
        ]);
        */

    }

    public function configureDashboard(): Dashboard
    {

        $appParam = $this->requestStack->getSession()->get('appParam');

        $dashboard = Dashboard::new();
        
            // the name visible to end users
            $dashboard
            //->setTitle('<img src="...">', $appParam->getName())
            // you can include HTML contents too (e.g. to link to an image)
            //$appParam->getName()
            ->setTitle((($appParam->getLogo())?'<img src="/uploads/logo/'.$appParam->getLogo().'"> ':''))
            
            // by default EasyAdmin displays a black square as its default favicon;
            // use this method to display a custom favicon: the given path is passed
            // "as is" to the Twig asset() function:
            // <link rel="shortcut icon" href="{{ asset('...') }}">
            ->setFaviconPath('/uploads/favicon/'.$appParam->getFavicon())

            // the domain used by default is 'messages'
            ->setTranslationDomain('admin')

            // there's no need to define the "text direction" explicitly because
            // its default value is inferred dynamically from the user locale
            //->setTextDirection('ltr')

            // set this option if you prefer the page content to span the entire
            // browser width, instead of the default design which sets a max width
            //->renderContentMaximized()

            // set this option if you prefer the sidebar (which contains the main menu)
            // to be displayed as a narrow column instead of the default expanded design
            //->renderSidebarMinimized()

            // by default, users can select between a "light" and "dark" mode for the
            // backend interface. Call this method if you prefer to disable the "dark"
            // mode for any reason (e.g. if your interface customizations are not ready for it)
            ->disableDarkMode()

            // by default, all backend URLs are generated as absolute URLs. If you
            // need to generate relative URLs instead, call this method
            //->generateRelativeUrls()

        ;

        //$dashboard->getAsDto()->setContentWidth(Crud::LAYOUT_CONTENT_FULL);
        
        return $dashboard;
    }

    public function configureMenuItems(): iterable
    {

        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-dashboard');
        yield MenuItem::linkToRoute('Homepage', 'fas fa-home', 'app_homepage');
        
        yield MenuItem::section('General');
            
        /*
        yield MenuItem::subMenu('Products', 'fas fa-cubes')->setSubItems([
            MenuItem::linkToCrud('Products', 'fas fa-cubes', Product::class),
            MenuItem::linkToCrud('Presentations', 'fas fa-envelope-open', Presentation::class),
            MenuItem::linkToCrud('Category', 'fas fa-table', Category::class),
            MenuItem::linkToCrud('Brand', 'fas fa-font-awesome', Brand::class),
        ]);
        */

        yield MenuItem::subMenu('Pages', 'fas fa-clipboard')->setSubItems([
            MenuItem::linkToCrud('Pages', 'fas fa-clipboard', Page::class),
            MenuItem::linkToCrud('Menu', 'fas fa-list', Menu::class),
            MenuItem::linkToCrud('Widgets', 'fas fa-diamond', Widget::class),
        ]); 

        yield MenuItem::subMenu('Gallery', 'fa fa-folder')->setSubItems([
            MenuItem::linkToCrud('Gallery', 'fas fa-folder', Gallery::class),
            MenuItem::linkToCrud('Gallery Images', 'fas fa-image', GalleryImages::class)
        ]);

        //yield MenuItem::section('Localization');
        yield MenuItem::subMenu('Localization', 'fa fa-globe-americas')->setSubItems([
            MenuItem::linkToCrud('Countries', 'fas fa-globe-americas', Country::class),
            MenuItem::linkToCrud('Languages', 'fas fa-globe', Language::class)
        ]);


        yield MenuItem::subMenu('Companies', 'fas fa-building')->setSubItems([
            MenuItem::linkToCrud('Companies', 'fas fa-building', Company::class),
            MenuItem::linkToCrud('Offices', 'fas fa-map-marked-alt', Office::class)
        ]);

        yield MenuItem::section('Security');
        
        
        yield MenuItem::linkToCrud('Users', 'fa fa-users', User::class)
                //->setPermission('ROLE_SUPERADMIN')
                ->setController(UserCrudController::class);

        //yield MenuItem::section('Users')->setPermission('ROLE_SUPERADMIN');
        //yield MenuItem::linkToUrl('Homepage', 'fas fa-home', $this->generateUrl('app_homepage'));

        /*
        MenuItem::subMenu('Users', 'fa fa-list')->setSubItems([
            MenuItem::linkToCrud('Users', 'fa fa-users', User::class),
        ]),
        */
    }

    /**
     * @param UserInterface|User $user
     */
    public function configureUserMenu(UserInterface $user): UserMenu
    {
        // Usually it's better to call the parent method because that gives you a
        // user menu with some menu items already created ("sign out", "exit impersonation", etc.)
        // if you prefer to create the user menu from scratch, use: return UserMenu::new()->...
        return parent::configureUserMenu($user)
            // use the given $user object to get the user name
            //->setName($user->getName())
            // use this method if you don't want to display the name of the user
            //->displayUserName(true)

            // you can return an URL with the avatar image
            //->setAvatarUrl('https://...')
            ->setAvatarUrl(($user->getAvatarUrl()) ? $user->getAvatarUrl() : $user->getAvatarUri())
            // use this method if you don't want to display the user image
            //->displayUserAvatar(false)
            // you can also pass an email address to use gravatar's service
            //->setGravatarEmail($user->getEmail())

            // you can use any type of menu item, except submenus
            //->addMenuItems([
                
            //    MenuItem::section('Localization'),
            //    MenuItem::linkToCrud('Countries', 'fas fa-list', Country::class),
            //    MenuItem::linkToCrud('Languages', 'fas fa-list', Language::class),
            //    
            //    MenuItem::section(),
            //    MenuItem::linkToLogout('Logout', 'fa fa-sign-out'),
            //])
        ;

    }

    public function configureActions(): Actions
    {
        return parent::configureActions()
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            
            /*
            ->update(Crud::PAGE_INDEX, Action::DELETE, static function(Action $action) {
                $action->displayIf(static function (User $user) {
                    return !$user->getIsActive();
                });

                return $action;
            })
            */
            
            ;
    }

    public function configureAssets(): Assets
    {
        return parent::configureAssets()
            ->addWebpackEncoreEntry('admin');
    }

    public function configureCrud(): Crud
    {
        return parent::configureCrud()
            ->overrideTemplate('crud/field/id', 'admin/field/id_with_icon.html.twig')
            ->setDefaultSort([
                    'id' => 'DESC',
            ]);
    }



    private function createChart($chartBuilder): Chart
    {
        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart->setData([
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [0, 10, 5, 2, 20, 30, 45],
                ],
            ],
        ]);
        $chart->setOptions([
            'scales' => [
                'y' => [
                   'suggestedMin' => 0,
                   'suggestedMax' => 100,
                ],
            ],
        ]);

        return $chart;
    }

}
