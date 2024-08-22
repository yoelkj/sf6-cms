<?php

namespace App\Components;

use App\Entity\Product;
use App\Entity\User;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Security;


use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('addToCart')]
class AddToCartComponent
{

    private UserRepository $repo_user;
    private ProductRepository $repo_product;
    private Security $security;

    public ?int $product;
    public ?User $user;
    public ?string $product_name;
    public ?bool $admin;
    public ?bool $show_form;


    public function __construct(

        Security $security,

        UserRepository $repo_user,
        ProductRepository $repo_product,

        $product = null,
        $user = null,
        $product_name = null,
        $admin = false,
        $show_form = false

    ) {

        $this->repo_user = $repo_user;
        $this->repo_product = $repo_product;
        $this->product = $product;
        $this->user = $user;
        $this->product_name = $product_name;
        $this->admin = $admin;
        $this->show_form = $show_form;
        $this->security = $security;
    }

    public function getSelectedUser()
    {
        return $this->user;
    }

    public function getData(): array
    {
        $this->user = $this->security->getUser();
        return $this->repo_user->getRow($this->user, $this->product, $this->admin);
    }
}
