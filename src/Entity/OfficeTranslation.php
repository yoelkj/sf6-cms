<?php

namespace App\Entity;

use App\Repository\OfficeTranslationRepository;
use Doctrine\ORM\Mapping as ORM;

use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait;

#[ORM\Entity(repositoryClass: OfficeTranslationRepository::class)]
class OfficeTranslation implements TranslationInterface
{
    use TranslationTrait;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 140)]
    private $name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $hours;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $days;

    #[ORM\Column(type: 'text', nullable: true)]
    private $body;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->getName().' - '.$this->getLocale();
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

    public function getHours(): ?string
    {
        return $this->hours;
    }

    public function setHours(?string $hours): self
    {
        $this->hours = $hours;

        return $this;
    }

    public function getDays(): ?string
    {
        return $this->days;
    }

    public function setDays(?string $days): self
    {
        $this->days = $days;

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
