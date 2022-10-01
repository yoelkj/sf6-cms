<?php

namespace App\Entity;

use App\Repository\GalleryImagesRepository;
use Doctrine\ORM\Mapping as ORM;

use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;


#[ORM\Entity(repositoryClass: GalleryImagesRepository::class)]
class GalleryImages implements TimestampableInterface
{
    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Language::class, inversedBy: 'galleryImages')]
    private $language;

    #[ORM\ManyToOne(targetEntity: Gallery::class, inversedBy: 'galleryImages')]
    private $gallery;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $link;

    #[ORM\Column(type: 'text', nullable: true)]
    private $body;
        
    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isActive = false;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $orderRow;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return 'Imagen - '.($this->language) ?? $this->language->getName();
    }

    public function getLanguage(): ?Language
    {
        return $this->language;
    }

    public function setLanguage(?Language $language): self
    {
        $this->language = $language;

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

    public function getImage(): ?string
    {
        return $this->image;
    }


    public function getImageUrl(): ?string
    {
        if (!$this->image) return null;
        if (strpos($this->image, '/') !== false) return $this->image;
        return sprintf('/uploads/gallery/%s', $this->image);
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

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

    public function getOrderRow(): ?int
    {
        return $this->orderRow;
    }

    public function setOrderRow(?int $orderRow): self
    {
        $this->orderRow = $orderRow;

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

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): self
    {
        $this->body = $body;

        return $this;
    }
}
