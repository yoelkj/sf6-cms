<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function configureFields(string $pageName): iterable
    {
        
        
        yield IdField::new('id')->onlyOnIndex();
        /*
        yield ImageField::new('bgImage')
                ->setBasePath('uploads/categories/bg')
                ->setUploadDir('public/uploads/categories/bg')
                ->setUploadedFileNamePattern('[slug]-bg-[timestamp].[extension]')
                //->setFormTypeOption('upload_new', function(){})
                ->onlyOnForms()
                ->setColumns(6);
        */
        yield CollectionField::new('translations')
            ->useEntryCrudForm()
            ->setColumns(12)
            ->formatValue(static function ($value, ?Category $category): ?string {

                $name = $category?->getTranslateName();
                $num_translations = $category?->getTranslations()->count();
                return sprintf('%s - %s translation(s)', $name, $num_translations);
            })

            //->renderExpanded()
            /*->setFormTypeOptions(['row_attr' => ['data-controller' => 'translations',],])*/
            ;
        
        yield IntegerField::new('orderRow')->onlyOnForms()->setColumns(2);    
        yield BooleanField::new('isActive');
        yield DateField::new('createdAt')->hideOnForm();
        yield DateField::new('updatedAt')->onlyOnForms()->hideOnForm();

    }
    
}
