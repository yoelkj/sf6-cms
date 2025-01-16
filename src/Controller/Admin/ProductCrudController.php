<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Service\CsvExporter;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\RequestStack;

use EasyCorp\Bundle\EasyAdminBundle\Factory\FilterFactory;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class ProductCrudController extends AbstractCrudController
{
    private AdminUrlGenerator $adminUrlGenerator;
    private RequestStack $requestStack;

    public function __construct(AdminUrlGenerator $adminUrlGenerator, RequestStack $requestStack)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
        $this->requestStack = $requestStack;
    }

    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->onlyOnIndex();

        yield ImageField::new('galleryImage.image', 'Thumbnail')
            ->setBasePath('uploads/gallery')
            ->setUploadDir('public/uploads/gallery')
            ->setRequired(false)
            ->onlyOnIndex();

        yield FormField::addTab('General')->setIcon('cog');
        yield FormField::addRow();
        yield Field::new('code')->setColumns(12);

        yield CollectionField::new('translations')
            ->useEntryCrudForm()
            ->setColumns(12)
            ->formatValue(static function ($value, ?Product $row): ?string {

                $name = $row?->getTranslateName();
                $num_translations = $row?->getTranslations()->count();
                return sprintf('%s - %s translation(s)', $name, $num_translations);
            });

        yield NumberField::new('weightGrammage')->onlyOnIndex();

        yield AssociationField::new('category')->onlyOnIndex();

        yield FormField::addRow();
        yield Field::new('price')->onlyOnForms()->setColumns(12);

        yield BooleanField::new('isNew')->onlyOnForms()->setColumns(3);
        yield BooleanField::new('isBestSeller')->onlyOnForms()->setColumns(3);
        yield BooleanField::new('isRecommended')->onlyOnForms()->setColumns(3);
        yield BooleanField::new('isActive')->onlyOnForms()->setColumns(3);

        yield FormField::addRow();
        yield IntegerField::new('orderRow')->setTextAlign('right')->onlyOnForms()->setColumns(2);

        yield FormField::addTab('Content')->setIcon('cogs');
        yield FormField::addRow();

        yield AssociationField::new('category')->onlyOnForms()->setColumns(4);
        yield AssociationField::new('brand')->onlyOnForms()->setColumns(4);
        yield AssociationField::new('presentation')->onlyOnForms()->setColumns(4);

        yield FormField::addRow();
        yield NumberField::new('weightGrammage')->onlyOnForms()->setColumns(3);
        yield IntegerField::new('quantityPerBox')->onlyOnForms()->setColumns(3);
        yield IntegerField::new('storageLifeMonths')->onlyOnForms()->setColumns(3);
        yield IntegerField::new('stock')->onlyOnForms()->setColumns(3);

        yield FormField::addRow();
        yield AssociationField::new('gallery')
            ->setCrudController(GalleryCrudController::class)
            ->setColumns(12);

        yield FormField::addRow();
        yield AssociationField::new('galleryImage')
            ->setCrudController(GalleryCrudController::class)
            ->setColumns(12);

        yield AssociationField::new('widgets')
            ->setColumns(12);


        yield AssociationField::new('relateds')
            ->setColumns(12);


        yield DateField::new('createdAt')->onlyOnForms()->hideOnForm();
        yield DateField::new('updatedAt')->onlyOnForms()->hideOnForm();
    }

    public function configureFilters(Filters $filters): Filters
    {
        return parent::configureFilters($filters)
            ->add('category')
            ->add('brand')
            ->add('createdAt')
            ->add(BooleanFilter::new('isActive'))
            //->add(BooleanFilter::new('enabled')->setFormTypeOption('expanded', false));

        ;
    }

    /*
    public function configureActions(Actions $actions): Actions
    {
        $exportAction = Action::new('export')
            //->linkToCrudAction('export')
            ->linkToUrl(function () {
                $request = $this->requestStack->getCurrentRequest();
                return $this->adminUrlGenerator->setAll($request->query->all())
                    ->setAction('export')
                    ->generateUrl();
            })

            ->addCssClass('btn btn-success')
            ->setIcon('fa fa-download')
            ->createAsGlobalAction();

        return parent::configureActions($actions)
            ->add(Crud::PAGE_INDEX, $exportAction)
            ;
    }
    */

    public function export(AdminContext $context, CsvExporter $csvExporter)
    {

        $fields = FieldCollection::new($this->configureFields(Crud::PAGE_INDEX));
        $context->getCrud()->setFieldAssets($this->getFieldAssets($fields));
        $filters = $this->container->get(FilterFactory::class)->create($context->getCrud()->getFiltersConfig(), $fields, $context->getEntity());
        $queryBuilder = $this->createIndexQueryBuilder($context->getSearch(), $context->getEntity(), $fields, $filters);

        return $csvExporter->createResponseFromQueryBuilder($queryBuilder, $fields, 'products.csv');
    }
}
