<?php

namespace App\Controller\Admin;

use App\Entity\Language as EntityLanguage;
use App\Entity\WidgetTranslation;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use JetBrains\PhpStorm\Language;

class WidgetTranslationCrudController extends AbstractCrudController
{
    private EntityManagerInterface $em;
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public static function getEntityFqcn(): string
    {
        return WidgetTranslation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->onlyOnIndex();

        $obj_languages = $this->em->getRepository(EntityLanguage::class)->getRows($is_active = 1);
        $arr_langs = [];
        foreach($obj_languages as $row) $arr_langs[$row->getCode()] = $row->getCode();
        yield FormField::addRow();
        yield ChoiceField::new('locale')->setFormTypeOptions([
            'attr' => [
                'required' => true,
            ],
        ])->setColumns(12)->onlyOnForms()->setChoices($arr_langs)->renderAsNativeWidget();

        yield FormField::addRow();
        yield Field::new('name', 'Name or title')->setFormTypeOptions([
            'attr' => ['required' => true],
        ])->setColumns(12);
        yield Field::new('subtitle')->setColumns(12);
        
        yield FormField::addRow();
        yield ImageField::new('bodyImage')
                ->setBasePath('uploads/widgets/body')
                ->setUploadDir('public/uploads/widgets/body')
                ->setUploadedFileNamePattern('[slug]-body-[timestamp].[extension]')
                ->onlyOnForms()
                ->setColumns(12);
        yield FormField::addRow();
        yield TextField::new('bodyVideo', 'Youtube video code')->onlyOnForms()->setColumns(12);

        yield FormField::addRow();
        yield TextareaField::new('body')
        ->setFormTypeOptions([
            'row_attr' => ['data-controller' => 'tinymce',],
            'attr' => ['data-tinymce-target' => 'input',],
        ])
        ->setColumns(12)
        
        /*
        ->setFormTypeOptions([
            'attr' => [
                'data-translations-target' => 'choice',
                'data-action' => 'change->translations#handleChoiceChange',
            ],
        ])
        */
        ;


        
    }
    
}
