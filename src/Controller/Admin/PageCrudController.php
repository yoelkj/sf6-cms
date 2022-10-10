<?php

namespace App\Controller\Admin;

use App\Entity\Page;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class PageCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Page::class;
    }

    public function configureFields(string $pageName): iterable
    {

        yield IdField::new('id')->onlyOnIndex();
            //->hideOnForm();
            
        yield FormField::addTab('General')->setIcon('cog');    
            
            yield CollectionField::new('translations')
                ->useEntryCrudForm()
                ->setColumns(12)
                ->formatValue(static function ($value, ?Page $page): ?string {

                    $name = $page?->getTranslateName();
                    $num_translations = $page?->getTranslations()->count();
                    return sprintf('%s - %s translation(s)', $name, $num_translations);
                
                });

            yield FormField::addRow();
            yield BooleanField::new('pullRightImage')->onlyOnForms()->setColumns(12);
            yield IntegerField::new('orderRow')->onlyOnForms()->setColumns(2);
            
            //yield BooleanField::new('isCatalog');
 
            yield BooleanField::new('useContactForm')->onlyOnForms();
            
            yield BooleanField::new('isHomepage')->onlyOnForms()->hideOnForm();
            yield BooleanField::new('isLocalHomepage')->onlyOnForms()->hideOnForm();

            yield BooleanField::new('isActive');
            
            yield BooleanField::new('isCore')->onlyOnForms();


        yield FormField::addTab('Content')->setIcon('cogs');
            yield AssociationField::new('menu')
            ;

            yield ImageField::new('bgImage')
                ->setBasePath('uploads/pages/bg')
                ->setUploadDir('public/uploads/pages/bg')
                ->setUploadedFileNamePattern('[slug]-bg-[timestamp].[extension]')
                //->setFormTypeOption('upload_new', function(){})
                ->onlyOnForms()
                ->setColumns(6);

            yield FormField::addRow();
            yield AssociationField::new('gallery')
                ->setCrudController(GalleryCrudController::class)
                ->onlyOnForms()
                ->setColumns(6);

            
            yield AssociationField::new('widgets')
                //->autocomplete()
                //->setFormTypeOption('by_reference', false)
                ;

        yield DateField::new('createdAt')->hideOnForm();
        yield DateField::new('updatedAt')->onlyOnForms()->hideOnForm();
    }
    
}
