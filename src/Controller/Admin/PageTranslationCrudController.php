<?php

namespace App\Controller\Admin;

use App\Entity\Language;
use App\Entity\PageTranslation;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class PageTranslationCrudController extends AbstractCrudController
{

    private EntityManagerInterface $em;
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public static function getEntityFqcn(): string
    {
        return PageTranslation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        
        yield IdField::new('id')->onlyOnIndex();

        $obj_languages = $this->em->getRepository(Language::class)->getRows($is_active = 1);
        $arr_langs = [];
        foreach($obj_languages as $row) $arr_langs[$row->getCode()] = $row->getCode();
        
        yield FormField::addRow();
        yield ChoiceField::new('locale')
            ->setFormTypeOptions([
                'attr' => [
                    'required' => true,
                ],
            ])    
            ->setColumns(6)->onlyOnForms()->setChoices(
                $arr_langs
            )->renderAsNativeWidget()->setColumns(12);;
        
        yield FormField::addRow();
        yield Field::new('name')
            ->setFormTypeOptions([
                'attr' => [
                    'required' => true,
                ],
            ])
            ->setColumns(12);
        
        yield FormField::addRow();
        yield SlugField::new('slug')
            ->setFormTypeOptions([
                'attr' => [
                    'required' => true,
                ],
            ])
            ->setColumns(12)->onlyOnForms()->setTargetFieldName('name');

        yield FormField::addRow();
        yield ImageField::new('bodyImage')
            ->setBasePath('uploads/pages/body')
            ->setUploadDir('public/uploads/pages/body')
            ->setUploadedFileNamePattern('[slug]-body-[timestamp].[extension]')
            ->onlyOnForms()
            ->setColumns(12);
            
        yield FormField::addRow();
        yield TextField::new('bodyVideo', 'Youtube video code')->onlyOnForms()->setColumns(12);    
        
        yield FormField::addRow();
        yield TextareaField::new('body')
            ->setFormTypeOptions([
                'row_attr' => [
                    'data-controller' => 'tinymce',
                ],
                'attr' => [
                    'data-tinymce-target' => 'input',
                ],
            ])
            ->setColumns(12)
        ;
    
    }
    
}
