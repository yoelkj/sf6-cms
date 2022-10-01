<?php

namespace App\Controller\Admin;

use App\Entity\Language;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class LanguageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Language::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        /*
        $viewAction = Action::new('view')
            ->linkToUrl(function(Language $language) {
                return $this->generateUrl('app_language_show', [
                    'name' => $language->getName(),
                ]);
            })
            ->setIcon('fa fa-eye')
            ->setLabel('View on site')
            ;
        */


        

        return parent::configureActions($actions)
            //->disable(Action::DETAIL)
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
            ->remove(Crud::PAGE_DETAIL, Action::DELETE)
            
            ;

            //->add(Crud::PAGE_DETAIL, $viewAction->addCssClass('btn btn-success'))
            //->add(Crud::PAGE_INDEX, $viewAction);

            //->setPermission(Action::INDEX, 'ROLE_MODERATOR')
            //->setPermission(Action::DETAIL, 'ROLE_MODERATOR')
            //->setPermission(Action::EDIT, 'ROLE_MODERATOR');
            //->setPermission(Action::NEW, 'ROLE_SUPER_ADMIN')
            //->setPermission(Action::DELETE, 'ROLE_SUPER_ADMIN');
            //->setPermission(Action::BATCH_DELETE, 'ROLE_SUPER_ADMIN');
            ;
    }

    
    public function configureFields(string $pageName): iterable
    {

        yield IdField::new('id')
            ->onlyOnIndex();
        yield Field::new('name');
        
        yield Field::new('code')
            //->setPermission('ROLE_SUPER_ADMIN')
        
        ;
        yield IntegerField::new('orderRow')->onlyOnForms();
        yield BooleanField::new('isActive');

        yield AssociationField::new('countries')
            ->autocomplete()
            ->setFormTypeOption('by_reference', false);

        yield DateField::new('createdAt')->hideOnForm();
        yield DateField::new('updatedAt')->onlyOnForms()->hideOnForm();
        
    }
    
}
