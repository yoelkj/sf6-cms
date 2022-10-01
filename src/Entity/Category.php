<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;
use Symfony\Component\Intl\Locale;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category implements TimestampableInterface,  TranslatableInterface
{
    use TimestampableTrait;
    use TranslatableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $orderRow;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isActive = false;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Product::class)]
    private $products;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Menu::class)]
    private $menus;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->menus = new ArrayCollection();
    }

    public function __toString(): string
    {
       return $this->getTranslateName();
    }
    
    public function getTranslateName(): ?string
    {
        $translate = $this->translate(Locale::getDefault())->getName();
        return ($translate) ? $translate : 'Translation not available for '.Locale::getDefault();
    }

    public function getTranslation(){
        $translate = $this->translate(Locale::getDefault());
        return ($translate) ? $translate : null;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setCategory($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getCategory() === $this) {
                $product->setCategory(null);
            }
        }

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

    /**
     * @return Collection<int, Menu>
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menu $menu): self
    {
        if (!$this->menus->contains($menu)) {
            $this->menus[] = $menu;
            $menu->setCategory($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        if ($this->menus->removeElement($menu)) {
            // set the owning side to null (unless already changed)
            if ($menu->getCategory() === $this) {
                $menu->setCategory(null);
            }
        }

        return $this;
    }

}
