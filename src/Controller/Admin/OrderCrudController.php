<?php

namespace App\Controller\Admin;

use App\Entity\Order;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OrderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Order::class;
    }

    public function configureFields(string $pageName): iterable
    {

        yield IdField::new('id')
            ->onlyOnIndex();

        yield AssociationField::new('user');

        yield DateField::new('dateDoc')
            //->setTextAlign('right')
        ;

        yield Field::new('Total');
        yield Field::new('Currency');
        yield Field::new('status');
        yield BooleanField::new('isActive')->onlyOnForms();
        //yield BooleanField::new('isDeleted')->onlyOnForms();

        yield DateField::new('createdAt')->onlyOnForms()->hideOnForm();
        yield DateField::new('updatedAt')->onlyOnForms()->hideOnForm();
    }
}
