<?php

namespace App\Components;

use App\Entity\Product;
use App\Repository\MenuRepository;
use App\Repository\ProductRepository;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('menuSecondary')]
class MenuComponent
{
    private MenuRepository $repo_menu;
    private ProductRepository $repo_product;

    public function __construct(MenuRepository $repo_menu, ProductRepository $repo_product)
    {
        $this->repo_menu = $repo_menu;
        $this->repo_product = $repo_product;
    }

    public function getMenuItems(): array
    {
        return $this->repo_menu->getParentRows();
    }

    public function getProducts(): array
    {
        $repo_product = $this->repo_product;
        $arr_params = [];

        $obj_qb = $repo_product->getCatalogData($arr_params, 1);
        $data = new Pagerfanta(new QueryAdapter($obj_qb));
        $data->setMaxPerPage(8);

        $arr_data['data'] = $data;
        //$arr_data['brand'] = null;
        //$arr_data['presentation'] = null;
        //$arr_data['category']     = null;
        //$arr_data['features']     = null;
        $arr_data['arr_filter_data'] = $repo_product->getFilterData();

        return $arr_data;
    }
}
