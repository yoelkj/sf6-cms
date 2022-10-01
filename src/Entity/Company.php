<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;
use Symfony\Component\Intl\Locale;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
class Company implements TimestampableInterface,  TranslatableInterface
{
    use TimestampableTrait;
    use TranslatableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $address;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $phoneMain;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $phoneSales;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $phoneSupport;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $emailMain;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $emailSales;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $emailSupport;

    #[ORM\Column(type: 'string', length: 140, nullable: true)]
    private $postalCode;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $taxIdent;

    #[ORM\Column(type: 'string', length: 60, nullable: true)]
    private $taxNumber;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2, nullable: true)]
    private $taxPorcent;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $logo;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $favicon;

    #[ORM\Column(type: 'string', length: 60, nullable: true)]
    private $bgColorMain;

    #[ORM\Column(type: 'string', length: 60, nullable: true)]
    private $bgColorSecondary;

    #[ORM\Column(type: 'string', length: 140, nullable: true)]
    private $province;

    #[ORM\Column(type: 'string', length: 140, nullable: true)]
    private $city;

    #[ORM\ManyToOne(targetEntity: Language::class, inversedBy: 'companies')]
    private $language;

    #[ORM\ManyToOne(targetEntity: Country::class, inversedBy: 'companies')]
    private $country;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isActive = false;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $primaryColor;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $secondaryColor;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $tertiaryColor;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: Office::class)]
    private $offices;

    #[ORM\Column(type: 'string', length: 140, nullable: true)]
    private $legalName;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logoSecondary = null;

    public function __construct()
    {
        $this->offices = new ArrayCollection();
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

    public function getTranslation(){
        $translate = $this->translate(Locale::getDefault());
        return ($translate) ? $translate : null;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhoneMain(): ?string
    {
        return $this->phoneMain;
    }

    public function setPhoneMain(?string $phoneMain): self
    {
        $this->phoneMain = $phoneMain;

        return $this;
    }

    public function getPhoneSales(): ?string
    {
        return $this->phoneSales;
    }

    public function setPhoneSales(?string $phoneSales): self
    {
        $this->phoneSales = $phoneSales;

        return $this;
    }

    public function getPhoneSupport(): ?string
    {
        return $this->phoneSupport;
    }

    public function setPhoneSupport(?string $phoneSupport): self
    {
        $this->phoneSupport = $phoneSupport;

        return $this;
    }

    public function getEmailMain(): ?string
    {
        return $this->emailMain;
    }

    public function setEmailMain(?string $emailMain): self
    {
        $this->emailMain = $emailMain;

        return $this;
    }

    public function getEmailSales(): ?string
    {
        return $this->emailSales;
    }

    public function setEmailSales(?string $emailSales): self
    {
        $this->emailSales = $emailSales;

        return $this;
    }

    public function getEmailSupport(): ?string
    {
        return $this->emailSupport;
    }

    public function setEmailSupport(?string $emailSupport): self
    {
        $this->emailSupport = $emailSupport;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getTaxIdent(): ?string
    {
        return $this->taxIdent;
    }

    public function setTaxIdent(?string $taxIdent): self
    {
        $this->taxIdent = $taxIdent;

        return $this;
    }

    public function getTaxNumber(): ?string
    {
        return $this->taxNumber;
    }

    public function setTaxNumber(?string $taxNumber): self
    {
        $this->taxNumber = $taxNumber;

        return $this;
    }

    public function getTaxPorcent(): ?string
    {
        return $this->taxPorcent;
    }

    public function setTaxPorcent(?string $taxPorcent): self
    {
        $this->taxPorcent = $taxPorcent;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getFavicon(): ?string
    {
        return $this->favicon;
    }

    public function setFavicon(?string $favicon): self
    {
        $this->favicon = $favicon;

        return $this;
    }

    public function getBgColorMain(): ?string
    {
        return $this->bgColorMain;
    }

    public function setBgColorMain(?string $bgColorMain): self
    {
        $this->bgColorMain = $bgColorMain;

        return $this;
    }

    public function getBgColorSecondary(): ?string
    {
        return $this->bgColorSecondary;
    }

    public function setBgColorSecondary(?string $bgColorSecondary): self
    {
        $this->bgColorSecondary = $bgColorSecondary;

        return $this;
    }

    public function getProvince(): ?string
    {
        return $this->province;
    }

    public function setProvince(?string $province): self
    {
        $this->province = $province;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
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

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

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

    public function getCreated()
    {
        return $this->created;
    }

    public function setCreated(?\DateTimeInterface $created): self
    {
        $this->created = $created;
        return $this;
    }

    public function getUpdated()
    {
        return $this->updated;
    }

    public function setUpdated(?\DateTimeInterface $updated): self
    {
        $this->updated = $updated;
        return $this;
    }

    public function getPrimaryColor(): ?string
    {
        return $this->primaryColor;
    }

    public function setPrimaryColor(?string $primaryColor): self
    {
        $this->primaryColor = $primaryColor;

        return $this;
    }

    public function getSecondaryColor(): ?string
    {
        return $this->secondaryColor;
    }

    public function setSecondaryColor(?string $secondaryColor): self
    {
        $this->secondaryColor = $secondaryColor;

        return $this;
    }

    public function getTertiaryColor(): ?string
    {
        return $this->tertiaryColor;
    }

    public function setTertiaryColor(?string $tertiaryColor): self
    {
        $this->tertiaryColor = $tertiaryColor;

        return $this;
    }

    /**
     * @return Collection<int, Office>
     */
    public function getOffices(): Collection
    {
        return $this->offices;
    }

    public function addOffice(Office $office): self
    {
        if (!$this->offices->contains($office)) {
            $this->offices[] = $office;
            $office->setCompany($this);
        }

        return $this;
    }

    public function removeOffice(Office $office): self
    {
        if ($this->offices->removeElement($office)) {
            // set the owning side to null (unless already changed)
            if ($office->getCompany() === $this) {
                $office->setCompany(null);
            }
        }

        return $this;
    }

    public function getLegalName(): ?string
    {
        return $this->legalName;
    }

    public function setLegalName(?string $legalName): self
    {
        $this->legalName = $legalName;

        return $this;
    }

    public function getLogoSecondary(): ?string
    {
        return $this->logoSecondary;
    }

    public function setLogoSecondary(?string $logoSecondary): self
    {
        $this->logoSecondary = $logoSecondary;

        return $this;
    }
}
