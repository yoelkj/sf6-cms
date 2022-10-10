<?php

namespace App\Controller\Admin;

use App\Entity\Company;
use App\Entity\Country;
use Doctrine\DBAL\Query\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\PercentField;

class CompanyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Company::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();

        yield FormField::addTab('General')->setIcon('info');
            yield Field::new('name')->setColumns(6);
            yield Field::new('legalName')->hideOnIndex()->setColumns(6);
            
            yield Field::new('address')->setColumns(12)->onlyOnForms()
                //->setTextAlign('right')
                ;
            yield Field::new('phoneMain')->setColumns(6);
            yield EmailField::new('emailMain')->setColumns(6);
            yield Field::new('phoneSales')->setColumns(6)->onlyOnForms();
            yield EmailField::new('emailSales')->setColumns(6)->onlyOnForms();
            yield Field::new('phoneSupport')->setColumns(6)->onlyOnForms();
            yield EmailField::new('emailSupport')->setColumns(6)->onlyOnForms();

            yield BooleanField::new('isActive')
            ;

        yield FormField::addTab('Customization')->setIcon('media');
            yield ImageField::new('logo')
                ->setColumns(6)
                ->setBasePath('uploads/logo')
                ->setUploadDir('public/uploads/logo')
                ->setUploadedFileNamePattern('logo-[timestamp].[extension]')
                //->setFormTypeOption('upload_new', function(){})
                ->onlyOnForms();
            yield ImageField::new('logoSecondary')
                ->setColumns(6)
                ->setBasePath('uploads/logo')
                ->setUploadDir('public/uploads/logo')
                ->setUploadedFileNamePattern('logo-[timestamp].[extension]')
                //->setFormTypeOption('upload_new', function(){})
            ->onlyOnForms();
            yield ImageField::new('favicon')
                ->setColumns(6)
                ->setBasePath('uploads/favicon')
                ->setUploadDir('public/uploads/favicon')
                ->setUploadedFileNamePattern('favicon-[timestamp].[extension]')
                //->setFormTypeOption('upload_new', function(){})
                ->onlyOnForms();
            
            yield FormField::addRow();
            yield ColorField::new('primaryColor')->setColumns(4)->onlyOnForms();
            yield ColorField::new('secondaryColor')->setColumns(4)->onlyOnForms(); 
            yield ColorField::new('tertiaryColor')->setColumns(4)->onlyOnForms();
            yield FormField::addRow();
            yield ColorField::new('bgColorMain')->setColumns(4)->onlyOnForms();
            yield ColorField::new('bgColorSecondary')->setColumns(4)->onlyOnForms();
            yield ColorField::new('bgColorTertiary')->setColumns(4)->onlyOnForms();

            //->showSample()->showValue()

        yield FormField::addTab('Localization')->setIcon('media');
            yield AssociationField::new('country')->setColumns(6);
            /*
            ->autocomplete()
            //->setCrudController(CountryCrudController::class
            ->formatValue(static function ($value, ?Company $company): ?string {
                if (!$user = $company?->getUser()) {
                    return null;
                }
                return sprintf('%s&nbsp;(%s)', $user->getEmail(), $user->getQuestions()->count());  
            })
            ->setQueryBuilder(function (QueryBuilder $qb) {
                $qb->andWhere('entity.isActive = :isAcctive')
                    ->setParameter('isAcctive', true);
            })
            */

            yield AssociationField::new('language')->setColumns(6);
            yield Field::new('province')->onlyOnForms()->setColumns(6);
            yield Field::new('city')->onlyOnForms()->setColumns(6);
            
            yield Field::new('postal_code')->onlyOnForms()->setColumns(6);
            yield FormField::addRow();
            yield Field::new('taxIdent')->onlyOnForms()->setColumns(4);
            yield Field::new('taxNumber')->onlyOnForms()->setColumns(4);
            yield PercentField::new('taxPorcent')->setColumns(4)->onlyOnForms()->setNumDecimals(2);
    
        ;

        yield FormField::addTab('Translations')->setIcon('info');
        yield CollectionField::new('translations')
            ->useEntryCrudForm()
            ->setColumns(12)
            ->onlyOnForms()
            /*
            ->formatValue(static function ($value, ?Company $company): ?string {
                $num_translations = $company?->getTranslations()->count();
                return sprintf('%s translation(s)', $num_translations);
            })
            */
        ;

        /*
        
        yield Field::new('slug')
            ->hideOnIndex();
            ->setFormTypeOption(
                'disabled',
                $pageName !== Crud::PAGE_NEW
            );

        yield TextField::new('answer')
            ->setTemplatePath('admin/field/integer.html.twig');
            ->setMaxLength(50);

        yield TextEditorField::new('question')
        yield TextareaField::new('question')
        yield TextareaField::new('question')
            ->hideOnIndex()
            ->setHelp('Preview:');
            ->setFormTypeOptions([
                'row_attr' => [
                    'data-controller' => 'snarkdown',
                ],
                'attr' => [
                    'data-snarkdown-target' => 'input',
                    'data-action' => 'snarkdown#render',
                ],
            ]);

        */        

        yield DateField::new('createdAt')->hideOnForm();
        yield DateField::new('updatedAt')->onlyOnForms()->hideOnForm();
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
            ->remove(Crud::PAGE_DETAIL, Action::DELETE)             
            ;       
    }
    
}
