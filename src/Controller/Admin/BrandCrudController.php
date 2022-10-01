<?php

namespace App\Controller\Admin;

use App\Entity\Brand;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class BrandCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Brand::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

        yield IdField::new('id')->onlyOnIndex();
        yield Field::new('name');
        yield SlugField::new('slug')->onlyOnForms()->setTargetFieldName('name');
        yield BooleanField::new('isActive');
        yield DateField::new('createdAt')->hideOnForm();
        yield DateField::new('updatedAt')->onlyOnForms()->hideOnForm();
    }
    
}
