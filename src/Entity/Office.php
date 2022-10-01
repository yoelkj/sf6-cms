<?php

namespace App\Entity;

use App\Repository\OfficeRepository;
use Doctrine\ORM\Mapping as ORM;

use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;
use Symfony\Component\Intl\Locale;

#[ORM\Entity(repositoryClass: OfficeRepository::class)]
class Office implements TimestampableInterface,  TranslatableInterface
{
    use TimestampableTrait;
    use TranslatableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Country::class, inversedBy: 'offices')]
    private $country;

    #[ORM\Column(type: 'string', length: 140, nullable: true)]
    private $province;

    #[ORM\Column(type: 'string', length: 140, nullable: true)]
    private $city;

    #[ORM\Column(type: 'string', length: 255)]
    private $address;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $postalCode;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isMain = false;

    #[ORM\Column(type: 'string', length: 140, nullable: true)]
    private $phoneMain;

    #[ORM\Column(type: 'string', length: 140, nullable: true)]
    private $phoneSales;

    #[ORM\Column(type: 'string', length: 140, nullable: true)]
    private $phoneSupport;

    #[ORM\Column(type: 'string', length: 140, nullable: true)]
    private $emailMain;

    #[ORM\Column(type: 'string', length: 140, nullable: true)]
    private $emailSales;

    #[ORM\Column(type: 'string', length: 140, nullable: true)]
    private $emailSupport;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isActive;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $orderRow;

    #[ORM\ManyToOne(targetEntity: Company::class, inversedBy: 'offices')]
    private $company;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

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

    public function isIsMain(): ?bool
    {
        return $this->isMain;
    }

    public function setIsMain(bool $isMain): self
    {
        $this->isMain = $isMain;

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

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }
}
