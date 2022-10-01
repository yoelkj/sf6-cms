<?php

namespace App\Controller\Admin;

use App\Entity\Gallery;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GalleryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Gallery::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->onlyOnIndex();
        yield BooleanField::new('isActive');
        yield Field::new('name')->setColumns(12);
        
        yield CollectionField::new('galleryImages')
            ->useEntryCrudForm()
            //->renderExpanded()
            ->setEntryIsComplex()
            
            ->formatValue(static function ($value, ?Gallery $gallery): ?string {
                $num_images = $gallery?->getGalleryImages()->count();
                return sprintf('%s Image(s)', $num_images);
            })
            ->setColumns(12);

        yield DateField::new('createdAt')->hideOnForm();
        yield DateField::new('updatedAt')->onlyOnForms()->hideOnForm();


    }
    
    
}
