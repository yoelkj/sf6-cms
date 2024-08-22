<?php

namespace App\Controller\Admin;

use App\Entity\CompanyTranslation;
use App\Entity\Language;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CompanyTranslationCrudController extends AbstractCrudController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public static function getEntityFqcn(): string
    {
        return CompanyTranslation::class;
    }


    public function configureFields(string $pageName): iterable
    {

        yield FormField::addRow();

        $obj_languages = $this->em->getRepository(Language::class)->getRows($is_active = 1);
        $arr_langs = [];
        foreach ($obj_languages as $row) $arr_langs[$row->getCode()] = $row->getCode();

        yield ChoiceField::new('locale')->onlyOnForms()->setChoices(
            $arr_langs
        )->setFormTypeOptions([
            'attr' => [
                'required' => true,
            ],
        ])->renderAsNativeWidget()->setColumns(12);

        yield TextField::new('slogan')->setColumns(12);

        yield FormField::addRow();
        yield TextField::new('wpCommerceText')->setColumns(12);
        yield FormField::addRow();
        yield TextareaField::new('wpCommerceBody')
            ->setFormTypeOptions([
                'row_attr' => [
                    'data-controller' => 'tinymce',
                ],
                'attr' => [
                    'data-tinymce-target' => 'input',
                ],
            ])
            ->setColumns(12);

        yield FormField::addRow();
        yield TextareaField::new('terms')
            ->setFormTypeOptions([
                'row_attr' => [
                    'data-controller' => 'tinymce',
                ],
                'attr' => [
                    'data-tinymce-target' => 'input',
                ],
            ])
            ->setColumns(12);
        yield TextareaField::new('dataProtection')
            ->setFormTypeOptions([
                'row_attr' => [
                    'data-controller' => 'tinymce',
                ],
                'attr' => [
                    'data-tinymce-target' => 'input',
                ],
            ])
            ->setColumns(12);
    }
}
