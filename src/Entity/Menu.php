<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;
use Symfony\Component\Intl\Locale;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu implements TimestampableInterface,  TranslatableInterface
{
    use TimestampableTrait;
    use TranslatableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $link;
    
    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'menus')]
    private $menus;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isActive;

    #[ORM\ManyToOne(targetEntity: Page::class, inversedBy: 'singlemenus')]
    private $page;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $orderRow;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'menus')]
    private $category;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isParent = false;

    #[ORM\ManyToOne(targetEntity: Brand::class, inversedBy: 'menus')]
    private $brand;

    public function __construct()
    {
        $this->menus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString(): string
    {
       return $this->getTranslateName();
    }
    
    public function getPageTranslateSlug(): ?string
    {
        $obj_page =  $this->page; 
        $obj_page_translation = ($obj_page) ? $obj_page->getTranslation():null;
        return ($obj_page)? $obj_page_translation->getSlug():'';
    }

    public function getTranslateName(): ?string
    {
        $translate = $this->translate(Locale::getDefault())->getName();
        return ($translate) ? $translate : 'Translation not available for '.Locale::getDefault();
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(self $menu): self
    {
        if (!$this->menus->contains($menu)) {
            $this->menus[] = $menu;
        }

        return $this;
    }

    public function removeMenu(self $menu): self
    {
        $this->menus->removeElement($menu);

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(?bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getPage(): ?Page
    {
        return $this->page;
    }

    public function setPage(?Page $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function getOrderRow(): ?int
    {
        return $this->orderRow;
    }

    public function setOrderRow(?int $orderRow): self
    {
        $this->orderRow = $orderRow;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getIsParent(): ?bool
    {
        return $this->isParent;
    }

    public function setIsParent(?bool $isParent): self
    {
        $this->isParent = $isParent;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }
}
