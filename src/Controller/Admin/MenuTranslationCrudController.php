<?php

namespace App\Controller\Admin;

use App\Entity\Language;
use App\Entity\MenuTranslation;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MenuTranslationCrudController extends AbstractCrudController
{
    private EntityManagerInterface $em;
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public static function getEntityFqcn(): string
    {
        return MenuTranslation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $obj_languages = $this->em->getRepository(Language::class)->getRows($is_active = 1);
        $arr_langs = [];
        foreach($obj_languages as $row) $arr_langs[$row->getCode()] = $row->getCode();
        
        yield ChoiceField::new('locale')->onlyOnForms()->setChoices(
            $arr_langs
        )->setFormTypeOptions([
            'attr' => [
                'required' => true,
            ],
        ])->renderAsNativeWidget()->setColumns(12);
        
        yield TextField::new('name')->setColumns(12);
   
    }
}
