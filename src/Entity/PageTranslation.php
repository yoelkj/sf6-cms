<?php

namespace App\Entity;

use App\Repository\PageTranslationRepository;
use Doctrine\ORM\Mapping as ORM;

use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait;

#[ORM\Entity(repositoryClass: PageTranslationRepository::class)]
class PageTranslation implements TranslationInterface
{
    use TranslationTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 140)]
    private $name;

    #[ORM\Column(type: 'string', length: 140)]
    private $slug;

    #[ORM\Column(type: 'text', nullable: true)]
    private $body;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $bodyImage;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $bodyVideo;

    public function __toString(): string
    {
        return $this->getName().' - '.$this->getLocale();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getBodyImage(): ?string
    {
        return $this->bodyImage;
    }

    public function getBodyImageUrl(): ?string
    {
        if (!$this->bodyImage) return null;
        if (strpos($this->bodyImage, '/') !== false) return $this->bodyImage;
        return sprintf('/uploads/pages/body/%s', $this->bodyImage);
    }

    public function setBodyImage(?string $bodyImage): self
    {
        $this->bodyImage = $bodyImage;

        return $this;
    }

    public function getBodyVideo(): ?string
    {
        return $this->bodyVideo;
    }

    public function setBodyVideo(?string $bodyVideo): self
    {
        $this->bodyVideo = $bodyVideo;

        return $this;
    }
}
