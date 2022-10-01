<?php

namespace App\Controller\Admin;

use App\Entity\Language;
use App\Entity\PresentationTranslation;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;

class PresentationTranslationCrudController extends AbstractCrudController
{
    private EntityManagerInterface $em;
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public static function getEntityFqcn(): string
    {
        return PresentationTranslation::class;
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
        yield SlugField::new('slug')->setFormTypeOptions([
            'attr' => [
                'required' => true,
            ],
        ])->setColumns(12)->onlyOnForms()->setTargetFieldName('name');
    }
    
}
