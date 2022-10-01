<?php

namespace App\Controller\Admin;

use App\Entity\Presentation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class PresentationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Presentation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->onlyOnIndex();

        yield CollectionField::new('translations')
            ->useEntryCrudForm()
            ->setColumns(12)
            ->formatValue(static function ($value, ?Presentation $row): ?string {

                $name = $row?->getTranslateName();
                $num_translations = $row?->getTranslations()->count();
                return sprintf('%s - %s translation(s)', $name, $num_translations);
        });

        yield BooleanField::new('isActive');
        yield DateField::new('createdAt')->hideOnForm();
        yield DateField::new('updatedAt')->onlyOnForms()->hideOnForm();
    }
    
}
