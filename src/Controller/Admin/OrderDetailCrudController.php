<?php

namespace App\Controller\Admin;

use App\Entity\OrderDetail;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OrderDetailCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OrderDetail::class;
    }

    public function configureFields(string $pageName): iterable
    {

        yield IdField::new('id')->onlyOnIndex();

        yield AssociationField::new('orderHead')->onlyOnIndex();
        yield AssociationField::new('product')->onlyOnIndex();

        yield Field::new('Amount');
        yield Field::new('Price');
        yield Field::new('Tax');
    }
}
