<?php

namespace App\Entity;

use App\Repository\GalleryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

#[ORM\Entity(repositoryClass: GalleryRepository::class)]
class Gallery implements TimestampableInterface
{
    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 140)]
    private $name;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isActive = false;

    #[ORM\OneToMany(mappedBy: 'gallery', targetEntity: GalleryImages::class, cascade: ["persist", "remove"])]
    private $galleryImages;

    #[ORM\OneToMany(mappedBy: 'gallery', targetEntity: Page::class)]
    private $pages;

    #[ORM\OneToMany(mappedBy: 'gallery', targetEntity: Widget::class)]
    private $widgets;

    #[ORM\OneToMany(mappedBy: 'gallery', targetEntity: Product::class)]
    private $products;

    public function __construct()
    {
        $this->galleryImages = new ArrayCollection();
        $this->pages = new ArrayCollection();
        $this->widgets = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
     * @return Collection<int, GalleryImages>
     */
    public function getGalleryImages(): Collection
    {
        return $this->galleryImages;
    }

    public function addGalleryImage(GalleryImages $galleryImage): self
    {
        if (!$this->galleryImages->contains($galleryImage)) {
            $this->galleryImages[] = $galleryImage;
            $galleryImage->setGallery($this);
        }

        return $this;
    }

    public function removeGalleryImage(GalleryImages $galleryImage): self
    {
        if ($this->galleryImages->removeElement($galleryImage)) {
            // set the owning side to null (unless already changed)
            if ($galleryImage->getGallery() === $this) {
                $galleryImage->setGallery(null);
            }
        }

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(?\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(?\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

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
            $page->setGallery($this);
        }

        return $this;
    }

    public function removePage(Page $page): self
    {
        if ($this->pages->removeElement($page)) {
            // set the owning side to null (unless already changed)
            if ($page->getGallery() === $this) {
                $page->setGallery(null);
            }
        }

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
            $widget->setGallery($this);
        }

        return $this;
    }

    public function removeWidget(Widget $widget): self
    {
        if ($this->widgets->removeElement($widget)) {
            // set the owning side to null (unless already changed)
            if ($widget->getGallery() === $this) {
                $widget->setGallery(null);
            }
        }

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
            $product->setGallery($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getGallery() === $this) {
                $product->setGallery(null);
            }
        }

        return $this;
    }


    public function getGalleryImagesByLanguage($lang){

        $arr_result = [];
        foreach ($this->galleryImages as $key => $row) {
            if($row->getLanguage()->getCode() == $lang){
                $arr_result[] = $row;
            }
        }
        
        return $arr_result;

    }

}
