<?php

namespace App\Controller\Admin;

use App\Entity\Office;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class OfficeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Office::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->onlyOnIndex();
        
        yield FormField::addTab('General')->setIcon('info');
            yield AssociationField::new('company')->setColumns(4);

            yield CollectionField::new('translations')
            ->useEntryCrudForm()
            ->setColumns(12)
            ->formatValue(static function ($value, ?Office $row): ?string {
                $name = $row?->getTranslateName();
                $num_translations = $row?->getTranslations()->count();
                return sprintf('%s - %s translation(s)', $name, $num_translations);
            })
            //->renderExpanded()
            /*->setFormTypeOptions(['row_attr' => ['data-controller' => 'translations',],])*/
            ;

            yield IntegerField::new('orderRow')->setTextAlign('right')->onlyOnForms()->setColumns(2);    
            yield BooleanField::new('isActive')->onlyOnForms();
            yield BooleanField::new('isMain')->onlyOnForms();


        yield FormField::addTab('Localization')->setIcon('info');    
            yield AssociationField::new('country')->setColumns(4);
            yield Field::new('province')->setColumns(4)->onlyOnForms();
            yield Field::new('city')->setColumns(4)->onlyOnForms();
            yield Field::new('address')->setColumns(12)->onlyOnForms();

        yield FormField::addTab('Contact')->setIcon('info');
            yield Field::new('phoneMain')->onlyOnForms()->setColumns(6);
            yield EmailField::new('emailMain')->onlyOnForms()->setColumns(6);
            yield Field::new('phoneSales')->setColumns(6)->onlyOnForms();
            yield EmailField::new('emailSales')->setColumns(6)->onlyOnForms();
            yield Field::new('phoneSupport')->setColumns(6)->onlyOnForms();
            yield EmailField::new('emailSupport')->setColumns(6)->onlyOnForms();
            ;
        
        yield BooleanField::new('isActive')->onlyOnIndex();
        yield BooleanField::new('isMain')->onlyOnIndex();
        yield DateField::new('createdAt')->hideOnForm();
        yield DateField::new('updatedAt')->onlyOnForms()->hideOnForm();

    }
    
}
