<?php 

namespace App\Components;

use App\Repository\ProductRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent('shortcut')]
class ShortcutComponent
{
    private ProductRepository $repo_p;

    public function __construct(ProductRepository $repo_p)
    {
        $this->repo_p = $repo_p;
    }

    #[ExposeInTemplate('products')]
    public function getProducts()
    {
        $recommends_prods = $this->repo_p->findBy(['isActive' => 1, 'isRecommended' => true], ['orderRow' => 'ASC'], 5);
        //$news_prods = $this->repo_p->findBy(['isActive' => 1, 'isNew' => true], ['orderRow' => 'ASC'], 5);
        //$bestsellers_prods = $this->repo_p->findBy(['isActive' => 1, 'isBestSeller' => true], ['orderRow' => 'ASC'], 5);
        $arr_data = [];
        $arr_data['recommendeds'] =  ['data' => $recommends_prods, 'title' => 'Recommendeds'];
        //$arr_data['news'] =  ['data' => $news_prods, 'title' => 'News'];
        //$arr_data['bestsellers']=  ['data' => $bestsellers_prods, 'title' => 'Bestsellers'];
        return $arr_data;
    }

}