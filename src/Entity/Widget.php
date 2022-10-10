<?php

namespace App\Entity;

use App\Repository\WidgetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

use Symfony\Component\Intl\Locale;

#[ORM\Entity(repositoryClass: WidgetRepository::class)]
class Widget implements TimestampableInterface,  TranslatableInterface
{
    use TimestampableTrait;
    use TranslatableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 140, nullable: true)]
    private $bgColor;

    #[ORM\Column(type: 'string', length: 140, nullable: true)]
    private $template;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $orderRow;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isCore = false;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isActive = false;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $bgImage;

    #[ORM\ManyToMany(targetEntity: Page::class, mappedBy: 'widgets')]
    #[ORM\OrderBy(['orderRow'=> "ASC"])]
    private $pages;

    #[ORM\ManyToOne(targetEntity: Gallery::class, inversedBy: 'widgets')]
    private $gallery;

    private $translateName;

    #[ORM\Column(type: 'string', length: 140, nullable: true)]
    private $textColor;

    #[ORM\ManyToMany(targetEntity: Product::class, mappedBy: 'widgets')]
    private $products;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $useRelatedProductsComponent = false;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $useNewProductsComponent = false;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $useBestSellerComponent = false;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $useRecommendedProductsComponent = false;

    #[ORM\Column(length: 140, nullable: true)]
    private ?string $titleColor = null;

    #[ORM\Column(length: 140, nullable: true)]
    private ?string $subtitleColor = null;

    #[ORM\Column(nullable: true)]
    private ?bool $pullRightImage = null;

    #[ORM\Column(length: 140, nullable: true)]
    private ?string $btnBgColor = null;

    #[ORM\Column(length: 140, nullable: true)]
    private ?string $btnTextColor = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $btnUrl = null;

    #[ORM\Column(length: 140, nullable: true)]
    private ?string $code = null;

    public function __construct()
    {
        $this->pages = new ArrayCollection();
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

    public function getTranslateBody(): ?string
    {
        $translate = $this->translate(Locale::getDefault())->getBody();
        return ($translate) ? $translate : 'Translation not available for '.Locale::getDefault();
    }

    public function getTranslateBodyImageUrl(): ?string
    {
        $translate = $this->translate(Locale::getDefault())->getBodyImageUrl();
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

    public function getBgColor(): ?string
    {
        return $this->bgColor;
    }

    public function setBgColor(?string $bgColor): self
    {
        $this->bgColor = $bgColor;

        return $this;
    }

    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function setTemplate(?string $template): self
    {
        $this->template = $template;

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

    public function isIsCore(): ?bool
    {
        return $this->isCore;
    }

    public function setIsCore(?bool $isCore): self
    {
        $this->isCore = $isCore;

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

    /**
     * @return Collection<int, Page>
     */
    public function getPages(): Collection
    {
        return $this->pages;
    }

    public function addPage(Page $page): self
    {
        if (!$this->pages->contains($page)) {
            $this->pages[] = $page;
            $page->addWidget($this);
        }

        return $this;
    }

    public function removePage(Page $page): self
    {
        if ($this->pages->removeElement($page)) {
            $page->removeWidget($this);
        }

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

    public function getBgImage(): ?string
    {
        return $this->bgImage;
    }

    public function setBgImage(string $bgImage): self
    {
        $this->bgImage = $bgImage;

        return $this;
    }

    public function getBgImageUrl(): ?string
    {
        if (!$this->bgImage) return null;
        if (strpos($this->bgImage, '/') !== false) return $this->bgImage;
        return sprintf('/uploads/widgets/bg/%s', $this->bgImage);
    }

    public function getTextColor(): ?string
    {
        return $this->textColor;
    }

    public function setTextColor(?string $textColor): self
    {
        $this->textColor = $textColor;

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
            $product->addWidget($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            $product->removeWidget($this);
        }

        return $this;
    }

    public function getUseRelatedProductsComponent(): ?bool
    {
        return $this->useRelatedProductsComponent;
    }

    public function setUseRelatedProductsComponent(?bool $useRelatedProductsComponent): self
    {
        $this->useRelatedProductsComponent = $useRelatedProductsComponent;

        return $this;
    }

    public function getUseNewProductsComponent(): ?bool
    {
        return $this->useNewProductsComponent;
    }

    public function setUseNewProductsComponent(?bool $useNewProductsComponent): self
    {
        $this->useNewProductsComponent = $useNewProductsComponent;

        return $this;
    }

    public function getUseBestSellerComponent(): ?bool
    {
        return $this->useBestSellerComponent;
    }

    public function setUseBestSellerComponent(?bool $useBestSellerComponent): self
    {
        $this->useBestSellerComponent = $useBestSellerComponent;

        return $this;
    }

    public function getUseRecommendedProductsComponent(): ?bool
    {
        return $this->useRecommendedProductsComponent;
    }

    public function setUseRecommendedProductsComponent(?bool $useRecommendedProductsComponent): self
    {
        $this->useRecommendedProductsComponent = $useRecommendedProductsComponent;

        return $this;
    }

    public function getTitleColor(): ?string
    {
        return $this->titleColor;
    }

    public function setTitleColor(?string $titleColor): self
    {
        $this->titleColor = $titleColor;

        return $this;
    }

    public function getSubtitleColor(): ?string
    {
        return $this->subtitleColor;
    }

    public function setSubtitleColor(?string $subtitleColor): self
    {
        $this->subtitleColor = $subtitleColor;

        return $this;
    }

    public function isPullRightImage(): ?bool
    {
        return $this->pullRightImage;
    }

    public function setPullRightImage(?bool $pullRightImage): self
    {
        $this->pullRightImage = $pullRightImage;

        return $this;
    }

    public function getBtnBgColor(): ?string
    {
        return $this->btnBgColor;
    }

    public function setBtnBgColor(?string $btnBgColor): self
    {
        $this->btnBgColor = $btnBgColor;

        return $this;
    }

    public function getBtnTextColor(): ?string
    {
        return $this->btnTextColor;
    }

    public function setBtnTextColor(?string $btnTextColor): self
    {
        $this->btnTextColor = $btnTextColor;

        return $this;
    }

    public function getBtnUrl(): ?string
    {
        return $this->btnUrl;
    }

    public function setBtnUrl(?string $btnUrl): self
    {
        $this->btnUrl = $btnUrl;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

}
