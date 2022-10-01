<?php

namespace App\Controller\Admin;

use App\Entity\Language;
use App\Entity\OfficeTranslation;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class OfficeTranslationCrudController extends AbstractCrudController
{
    private EntityManagerInterface $em;
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public static function getEntityFqcn(): string
    {
        return OfficeTranslation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->onlyOnIndex();

        $obj_languages = $this->em->getRepository(Language::class)->getRows($is_active = 1);
        $arr_langs = [];
        foreach($obj_languages as $row) $arr_langs[$row->getCode()] = $row->getCode();
        
        yield ChoiceField::new('locale')->setColumns(6)->onlyOnForms()->setChoices(
            $arr_langs
        )->setFormTypeOptions([
            'attr' => [
                'required' => true,
            ],
        ])->renderAsNativeWidget()->setColumns(12);

        yield Field::new('name')->setColumns(12)->setFormTypeOptions([
            'attr' => [
                'required' => true,
            ],
        ]);

        yield Field::new('hours')->setColumns(12);

        yield Field::new('days')->setColumns(12);
        
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
