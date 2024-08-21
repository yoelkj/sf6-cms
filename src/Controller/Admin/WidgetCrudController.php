<?php

namespace App\Controller\Admin;

use App\Entity\Widget;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class WidgetCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Widget::class;
    }

    public function configureFields(string $pageName): iterable
    {

        yield FormField::addTab('General')->setIcon('cog');
        yield FormField::addRow();

        yield IdField::new('id')->onlyOnIndex();
        yield Field::new('orderRow')->onlyOnIndex();

        yield ChoiceField::new('template')->setColumns(12)->onlyOnForms()->setChoices([
            'Simple content' => 'TEMPLATE_CONTENT_SIMPLE',
            'Content Caroucel' => 'TEMPLATE_CONTENT_CAROUCEL',
            'Blog resume' => 'TEMPLATE_BLOG_RESUME',
            'Lightbox images' => 'TEMPLATE_LIGHTBOX_IMAGES',
            'Main Caroucel' => 'TEMPLATE_MAIN_CAROUCEL',
            'Office' => 'TEMPLATE_OFFICE',
            'One fluid image' => 'TEMPLATE_ONE_FLUID_IMAGE',
            //'Only component' => 'TEMPLATE_ONLY_COMPONENT',
            'Subscription' => 'TEMPLATE_SUBSCRIPTION',
            'Video' => 'TEMPLATE_VIDEO',
        ]);

        yield FormField::addRow();
        yield CollectionField::new('translations')
            ->useEntryCrudForm()
            //->renderExpanded()
            ->setColumns(12)
            ->formatValue(static function ($value, ?Widget $widget): ?string {
                $name = $widget?->getTranslateName();
                $num_translations = $widget?->getTranslations()->count();
                return sprintf('%s - %s translation(s)', $name, $num_translations);
            });

        yield FormField::addRow();
        yield AssociationField::new('gallery')
            ->setCrudController(GalleryCrudController::class)
            ->setColumns(6);
        yield IntegerField::new('orderRow')->setColumns(6)->onlyOnForms();

        yield FormField::addRow();
        yield BooleanField::new('isActive')->setColumns(4);
        yield BooleanField::new('isCore')->setColumns(4)->onlyOnForms();

        yield DateField::new('createdAt')->hideOnForm();
        yield DateField::new('updatedAt')->onlyOnForms()->hideOnForm();

        yield FormField::addTab('Design')->setIcon('cogs');
        yield FormField::addRow();
        yield ImageField::new('bgImage')
            ->setBasePath('uploads/widgets/bg')
            ->setUploadDir('public/uploads/widgets/bg')
            ->setUploadedFileNamePattern('[slug]-bg-[timestamp].[extension]')
            //->setFormTypeOption('upload_new', function(){})
            ->onlyOnForms()
            ->setColumns(12);

        yield FormField::addRow();
        yield ColorField::new('bgColor')->setColumns(3)->onlyOnForms()->showValue();
        yield ColorField::new('textColor')->setColumns(3)->onlyOnForms()->showValue();
        yield ColorField::new('titleColor')->setColumns(3)->onlyOnForms()->showValue();
        yield ColorField::new('subtitleColor')->setColumns(3)->onlyOnForms()->showValue();

        yield FormField::addRow();
        yield BooleanField::new('pullRightImage')->onlyOnForms()->setColumns(12);

        yield FormField::addRow();
        yield ColorField::new('btnBgColor', 'Button bg color')->setColumns(3)->onlyOnForms()->showValue();
        yield ColorField::new('btnTextColor', 'Button text color')->setColumns(3)->onlyOnForms()->showValue();
        yield Field::new('btnUrl', 'Button link')->setColumns(12)->onlyOnForms();

        yield BooleanField::new('isFluid')->setColumns(4)->onlyOnForms();



        /*
        yield FormField::addTab('Use components')->setIcon('cogs');
            yield FormField::addRow();
            yield BooleanField::new('useRelatedProductsComponent')->onlyOnForms();
            yield BooleanField::new('useNewProductsComponent')->onlyOnForms();
            yield BooleanField::new('useBestSellerComponent')->onlyOnForms();
            yield BooleanField::new('useRecommendedProductsComponent')->onlyOnForms();
        */
    }
}
