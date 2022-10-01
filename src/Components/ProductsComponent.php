<?php 

namespace App\Components;

use App\Repository\ProductRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent('products')]
class ProductsComponent
{
    public string $type = 'relateds';
    public string $title;
    public int $product;

    private ProductRepository $repo_p;

    public function __construct(ProductRepository $repo_p)
    {
        $this->repo_p = $repo_p;
    }

    #[ExposeInTemplate('products')]
    public function getProducts()
    {
        $products = [];
        
        switch ($this->type) {
            case 'relateds':
                
                if($this->product){
                    $obj_product = $this->repo_p->find($this->product);
                    $products =  $obj_product->getRelateds();
                }else{
                    $products =  $this->repo_p->findBy(['isActive' => 1], ['orderRow' => 'ASC'], 10);
                }
                break;
            case 'recommendeds':
                $products =  $this->repo_p->findBy(['isActive' => 1], ['isRecommended' => true], 10);
            case 'news':
                $products =  $this->repo_p->findBy(['isActive' => 1], ['isNew' => true], 10);
            case 'bestsellers':
                $products =  $this->repo_p->findBy(['isActive' => 1], ['isBestseller' => true], 10);
        }

        return $products;
    }

}