<?php

namespace App\Entity;

use App\Repository\PresentationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;
use Symfony\Component\Intl\Locale;

#[ORM\Entity(repositoryClass: PresentationRepository::class)]
class Presentation implements TimestampableInterface,  TranslatableInterface
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

    #[ORM\OneToMany(mappedBy: 'presentation', targetEntity: Product::class)]
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
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
            $product->setPresentation($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getPresentation() === $this) {
                $product->setPresentation(null);
            }
        }

        return $this;
    }

}
