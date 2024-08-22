<?php

namespace App\Entity;

use App\Repository\CompanyTranslationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait;

#[ORM\Entity(repositoryClass: CompanyTranslationRepository::class)]
class CompanyTranslation implements TranslationInterface
{
    use TranslationTrait;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $slogan;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $wpCommerceText;

    #[ORM\Column(type: 'text', nullable: true)]
    private $wpCommerceBody;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $terms = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $dataProtection = null;

    public function __toString(): string
    {
        return 'Translation - '.$this->getLocale();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlogan(): ?string
    {
        return $this->slogan;
    }

    public function setSlogan(string $slogan): self
    {
        $this->slogan = $slogan;

        return $this;
    }

    public function getwpCommerceText(): ?string
    {
        return $this->wpCommerceText;
    }

    public function setwpCommerceText(?string $wpCommerceText): self
    {
        $this->wpCommerceText = $wpCommerceText;

        return $this;
    }

    public function getWpCommerceBody(): ?string
    {
        return $this->wpCommerceBody;
    }

    public function setWpCommerceBody(?string $wpCommerceBody): self
    {
        $this->wpCommerceBody = $wpCommerceBody;

        return $this;
    }

    public function getTerms(): ?string
    {
        return $this->terms;
    }

    public function setTerms(?string $terms): static
    {
        $this->terms = $terms;

        return $this;
    }

    public function getDataProtection(): ?string
    {
        return $this->dataProtection;
    }

    public function setDataProtection(?string $dataProtection): static
    {
        $this->dataProtection = $dataProtection;

        return $this;
    }
}
