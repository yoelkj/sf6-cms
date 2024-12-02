<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;
use Symfony\Component\Intl\Locale;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product implements TimestampableInterface,  TranslatableInterface
{
    use TimestampableTrait;
    use TranslatableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 140)]
    private $code;

    #[ORM\Column(type: 'decimal', precision: 6, scale: 2, nullable: true)]
    private $weightGrammage;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $quantityPerBox;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $storageLifeMonths;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'products')]
    private $category;

    #[ORM\ManyToOne(targetEntity: Brand::class, inversedBy: 'products')]
    private $brand;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isNew = false;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isBestSeller = false;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isRecommended = false;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isActive = false;

    #[ORM\ManyToOne(targetEntity: Presentation::class, inversedBy: 'products')]
    private $presentation;

    #[ORM\ManyToOne(targetEntity: Gallery::class, inversedBy: 'products')]
    private $gallery;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $orderRow;

    #[ORM\ManyToMany(targetEntity: Widget::class, inversedBy: 'products')]
    private $widgets;

    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'products')]
    private $relateds;

    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'relateds')]
    private $products;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: OrderDetail::class)]
    private Collection $orderDetails;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $price = null;

    #[ORM\Column(nullable: true)]
    private ?int $stock = null;

    public function __construct()
    {
        $this->widgets = new ArrayCollection();
        $this->relateds = new ArrayCollection();
        $this->products = new ArrayCollection();
        $this->orderDetails = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getTranslateName();
    }

    public function getTranslateName(): ?string
    {
        $translate = $this->translate(Locale::getDefault())->getName();
        return ($translate) ? $translate : 'Translation not available for ' . Locale::getDefault();
    }

    public function getTranslation()
    {
        $translate = $this->translate(Locale::getDefault());
        return ($translate) ? $translate : null;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getWeightGrammage(): ?string
    {
        return $this->weightGrammage;
    }

    public function setWeightGrammage(?string $weightGrammage): self
    {
        $this->weightGrammage = $weightGrammage;

        return $this;
    }

    public function getQuantityPerBox(): ?int
    {
        return $this->quantityPerBox;
    }

    public function setQuantityPerBox(?int $quantityPerBox): self
    {
        $this->quantityPerBox = $quantityPerBox;

        return $this;
    }

    public function getStorageLifeMonths(): ?int
    {
        return $this->storageLifeMonths;
    }

    public function setStorageLifeMonths(?int $storageLifeMonths): self
    {
        $this->storageLifeMonths = $storageLifeMonths;

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

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function isIsNew(): ?bool
    {
        return $this->isNew;
    }

    public function setIsNew(?bool $isNew): self
    {
        $this->isNew = $isNew;

        return $this;
    }

    public function isIsBestSeller(): ?bool
    {
        return $this->isBestSeller;
    }

    public function setIsBestSeller(?bool $isBestSeller): self
    {
        $this->isBestSeller = $isBestSeller;

        return $this;
    }

    public function isIsRecommended(): ?bool
    {
        return $this->isRecommended;
    }

    public function setIsRecommended(?bool $isRecommended): self
    {
        $this->isRecommended = $isRecommended;

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


    public function getCreated(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreated(?\DateTimeInterface $created): self
    {
        $this->createdAt = $created;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdated(?\DateTimeInterface $updated): self
    {
        $this->updatedAt = $updated;

        return $this;
    }


    public function getPresentation(): ?Presentation
    {
        return $this->presentation;
    }

    public function setPresentation(?Presentation $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getGallery(): ?Gallery
    {
        return $this->gallery;
    }

    public function setGallery(?Gallery $gallery): self
    {
        $this->gallery = $gallery;

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
     * @return Collection<int, Widget>
     */
    public function getWidgets(): Collection
    {
        return $this->widgets;
    }

    public function addWidget(Widget $widget): self
    {
        if (!$this->widgets->contains($widget)) {
            $this->widgets[] = $widget;
        }

        return $this;
    }

    public function removeWidget(Widget $widget): self
    {
        $this->widgets->removeElement($widget);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getRelateds(): Collection
    {
        return $this->relateds;
    }

    public function addRelated(self $related): self
    {
        if (!$this->relateds->contains($related)) {
            $this->relateds[] = $related;
        }

        return $this;
    }

    public function removeRelated(self $related): self
    {
        $this->relateds->removeElement($related);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(self $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->addRelated($this);
        }

        return $this;
    }

    public function removeProduct(self $product): self
    {
        if ($this->products->removeElement($product)) {
            $product->removeRelated($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, OrderDetail>
     */
    public function getOrderDetails(): Collection
    {
        return $this->orderDetails;
    }

    public function addOrderDetail(OrderDetail $orderDetail): static
    {
        if (!$this->orderDetails->contains($orderDetail)) {
            $this->orderDetails->add($orderDetail);
            $orderDetail->setProduct($this);
        }

        return $this;
    }

    public function removeOrderDetail(OrderDetail $orderDetail): static
    {
        if ($this->orderDetails->removeElement($orderDetail)) {
            // set the owning side to null (unless already changed)
            if ($orderDetail->getProduct() === $this) {
                $orderDetail->setProduct(null);
            }
        }

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(?int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }
}
