<?php 

namespace App\Components;

use App\Repository\MenuRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('menuSecondary')]
class MenuComponent
{
    private MenuRepository $repo_menu;

    public function __construct(MenuRepository $repo_menu)
    {
        $this->repo_menu = $repo_menu;
    }

    public function getMenuItems(): array
    {
        return $this->repo_menu->getParentRows();
    }

}