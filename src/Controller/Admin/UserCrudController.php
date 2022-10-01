<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Service\CsvExporter;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Factory\FilterFactory;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AvatarField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[IsGranted('ROLE_ADMIN')]
class UserCrudController extends AbstractCrudController
{
    /*
    private AdminUrlGenerator $adminUrlGenerator;
    private RequestStack $requestStack;
    
    public function __construct(AdminUrlGenerator $adminUrlGenerator, RequestStack $requestStack)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
        $this->requestStack = $requestStack;
    }
    */

    private UserPasswordHasherInterface $passwordEncoder;
    public function __construct(UserPasswordHasherInterface $passwordEncoder){
        $this->passwordEncoder = $passwordEncoder;
    }

    

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        /*
        $activeAction = Action::new('active')
            ->addCssClass('btn btn-success')
            ->setIcon('fa fa-check-circle')
            ->displayAsButton()
            ->linkToCrudAction('active')
            ->setTemplatePath('admin/action/active.html.twig')
            ->displayIf(static function (User $user): bool {
                return !$user->isIsActive();
            });
        
        $exportAction = Action::new('export')
            //->linkToCrudAction('export')
            ->linkToUrl(function () {
                $request = $this->requestStack->getCurrentRequest();
                return $this->adminUrlGenerator->setAll($request->query->all())
                    ->setAction('export')
                    ->generateUrl();
            })

            ->addCssClass('btn btn-success')
            ->setIcon('fa fa-download')
            ->createAsGlobalAction();
            */

        return parent::configureActions($actions)
            //->add(Crud::PAGE_DETAIL, $activeAction)
            //->add(Crud::PAGE_INDEX, $exportAction)
            
            /*
            ->update(Crud::PAGE_DETAIL, Action::EDIT, static function (Action $action) {
                return $action->setIcon('fa fa-edit');
            })
            ->update(Crud::PAGE_DETAIL, Action::INDEX, static function (Action $action) {
                return $action->setIcon('fa fa-list');
            });
            ->reorder(Crud::PAGE_DETAIL, [
                'approve',
                'view',
                Action::EDIT,
                Action::INDEX,
                Action::DELETE,
            ]);
            */
            
            ;

            
    }

    /*
    public function configureFilters(Filters $filters): Filters
    {
        return parent::configureFilters($filters)
            ->add('isActive')
            //->add(BooleanFilter::new('enabled'))
            //->add(BooleanFilter::new('enabled')->setFormTypeOption('expanded', false));
            
            ;
    }
    */

    /*
    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $queryBuilder = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);

        if ($this->isGranted('ROLE_SUPER_ADMIN')) {
            return $queryBuilder;
        }

        $queryBuilder
            ->andWhere('entity.id = :id')
            ->setParameter('id', $this->getUser()->getId());

        return $queryBuilder;
        
    }
    */

    
    public function configureFields(string $pageName): iterable
    {

        //yield FormField::addPanel('Details')
        //    ->collapsible();
        //    ->setIcon('fa fa-info')
        //    ->setHelp('Additional Details');

        //FormField::addPanel('Basic Data')->addCssClass('col-md-9')


        //yield FormField::addTab('Basic Data')->setIcon('info')        

        yield FormField::addPanel( 'User data' )->setIcon( 'fa fa-user' );

        yield IdField::new('id')
            ->onlyOnForms()
            ->hideOnForm();

        yield AvatarField::new('avatar')
            ->formatValue(static function ($value, ?User $user) {

                $avatar_url = null;    
                if($user?->getAvatarUrl()) $avatar_url = $user?->getAvatarUrl();
                else $avatar_url = $user?->getAvatarUri();

                return $avatar_url;
            
            })
            ->hideOnForm();
        
        yield ImageField::new('avatar')
            ->setBasePath('uploads/avatars')
            ->setUploadDir('public/uploads/avatars')
            ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
            //->setFormTypeOption('upload_new', function(){})
            ->onlyOnForms();

        /*
        yield TextField::new('password')
            ->onlyOnForms()
            ->setFormType(PasswordType::class);
        */
        /*
        yield TextField::new('password')
            
            ->hideOnForm()
            //->setColumns(5)
            ;
            */

        /*
        yield TextField::new('password')
            ->onlyOnForms()
            ->setFormType(PasswordType::class)
            ->setFormTypeOption('empty_data', '')
            ->setRequired(false)
            ->setHelp('If the right is not given, leave the field blank.');
        */
        
        
        yield EmailField::new('email');
        yield TextField::new('name');
        

        //yield FormField::addPanel('Basic Data')
        //    ->collapsible()
        //    ->setIcon('fa fa-info')
        //    ->setHelp('Additional Details');
        

        //yield FormField::addTab('Details')
        
        /*
        yield ArrayField::new('roles')
            ->setHelp('Available roles: ROLE_ADMIN, ROLE_USER');
        */
        
        /*
        $roles = ['ROLE_ADMIN', 'ROLE_USER'];
        yield ChoiceField::new('roles')
            ->setChoices(array_combine($roles, $roles))
            ->allowMultipleChoices()
            ->renderExpanded()
            ->renderAsBadges();
        */
        yield BooleanField::new('isVerified');
        yield BooleanField::new('isActive');

        yield DateField::new('createdAt')->hideOnForm();
        yield DateField::new('updatedAt')->onlyOnForms()->hideOnForm();

        yield FormField::addPanel( 'Change password' )->setIcon( 'fa fa-key' );

        yield AssociationField::new('profile')->onlyOnForms()->setColumns(4);

        yield Field::new( 'password', 'New password' )->onlyWhenCreating()->setRequired( true )
                   ->setFormType( RepeatedType::class )
                   ->setFormTypeOptions( [
                       'type'            => PasswordType::class,
                       'first_options'   => [ 'label' => 'New password' ],
                       'second_options'  => [ 'label' => 'Repeat password' ],
                       'error_bubbling'  => true,
                       'invalid_message' => 'The password fields do not match.',
                   ] )->setColumns(4);;

        yield Field::new( 'password', 'New password' )->onlyWhenUpdating()->setRequired( false )
                   ->setFormType( RepeatedType::class )
                   ->setFormTypeOptions( [
                       'type'            => PasswordType::class,
                       'first_options'   => [ 'label' => 'New password' ],
                       'second_options'  => [ 'label' => 'Repeat password' ],
                       'error_bubbling'  => true,
                       'invalid_message' => 'The password fields do not match.',
                   ] )->setColumns(4);;



        /*
        ->onlyOnIndex();
        ->onlyOnForms();
        
        */
        

        /*
        return [
            IdField::new('id'),
            TextField::new('name'),
        ];
        */
    }

    public function configureCrud(Crud $crud): Crud
    {
        //'language.isActive' => 'DESC',
        return parent::configureCrud($crud)
            ->setDefaultSort([
                'isActive' => 'DESC',
                'createdAt' => 'DESC',
            ])
            //->setEntityPermission('ADMIN_USER_EDIT');
            ;
    }


    /*
    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $user = $this->getUser();
        if (!$user instanceof User) {
            throw new \LogicException('Currently logged in user is not an instance of User?!');
        }

        //Update to is active when updated user
        $entityInstance->setIsActive(true);

        parent::updateEntity($entityManager, $entityInstance);
    }
    */

    /*
    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance->isIsActive()) {
            throw new \Exception('Deleting approved questions is forbidden!');
        }
        parent::deleteEntity($entityManager, $entityInstance);
    }
    */


    //Custom methods

        /*
    public function active(AdminContext $adminContext, EntityManagerInterface $em, AdminUrlGenerator $adminUrlGenerator)
    {
        $user = $adminContext->getEntity()->getInstance();
        if (!$user instanceof User) {
            throw new \LogicException('Entity is missing or not a User');
        }
        
        //Save data
        $user->setIsActive(!$user->isIsActive());
        $em->flush();

        //redirect after save
        $targetUrl = $adminUrlGenerator
            ->setController(self::class)
            ->setAction(Crud::PAGE_DETAIL)
            ->setEntityId($user->getId())
            ->generateUrl();

        return $this->redirect($targetUrl);
        
    }

    public function export(AdminContext $context, CsvExporter $csvExporter)
    {

        $fields = FieldCollection::new($this->configureFields(Crud::PAGE_INDEX));
        $context->getCrud()->setFieldAssets($this->getFieldAssets($fields));
        $filters = $this->container->get(FilterFactory::class)->create($context->getCrud()->getFiltersConfig(), $fields, $context->getEntity());
        $queryBuilder = $this->createIndexQueryBuilder($context->getSearch(), $context->getEntity(), $fields, $filters);

        return $csvExporter->createResponseFromQueryBuilder($queryBuilder, $fields, 'users.csv');
    }
    
    */


    public function createEditFormBuilder( EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context ): FormBuilderInterface {
        $plainPassword = $entityDto->getInstance()?->getPassword();
        
        //dd($plainPassword);
        
        $formBuilder   = parent::createEditFormBuilder( $entityDto, $formOptions, $context );
        $this->addEncodePasswordEventListener( $formBuilder, $plainPassword );

        return $formBuilder;
    }

    public function createNewFormBuilder( EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context ): FormBuilderInterface {
        $formBuilder = parent::createNewFormBuilder( $entityDto, $formOptions, $context );
        $this->addEncodePasswordEventListener( $formBuilder );

        return $formBuilder;
    }

    protected function addEncodePasswordEventListener( FormBuilderInterface $formBuilder, $plainPassword = null ): void {
        $formBuilder->addEventListener( FormEvents::SUBMIT, function ( FormEvent $event ) use ( $plainPassword ) {
            /** @var User $user */
            $user = $event->getData();

            //dd($plainPassword, $user->getPassword());
            if ( $user->getPassword() !== $plainPassword ) {
                $user->setPassword( $this->passwordEncoder->hashPassword( $user, $user->getPassword() ) );
            }
        } );
    }
    
}
