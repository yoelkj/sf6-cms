<?php

namespace App\Entity;

use App\Repository\LanguageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

#[ORM\Entity(repositoryClass: LanguageRepository::class)]
class Language implements TimestampableInterface
{
    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 140, nullable: true)]
    private $name;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private $code;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isActive = false;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $orderRow;

    #[ORM\OneToMany(mappedBy: 'language', targetEntity: Company::class, orphanRemoval: true)]
    private $companies;

    #[ORM\OneToMany(mappedBy: 'language', targetEntity: Country::class, orphanRemoval: true)]
    private $countries;

    #[ORM\OneToMany(mappedBy: 'language', targetEntity: GalleryImages::class)]
    private $galleryImages;

    public function __construct()
    {
        $this->companies = new ArrayCollection();
        $this->countries = new ArrayCollection();
        $this->galleryImages = new ArrayCollection();
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

    public function setName(?string $name): self
    {
        $this->name = $name;

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

    /**
     * @return Collection<int, Company>
     */
    public function getCompanies(): Collection
    {
        return $this->companies;
    }

    public function addCompany(Company $company): self
    {
        if (!$this->companies->contains($company)) {
            $this->companies[] = $company;
            $company->setLanguage($this);
        }

        return $this;
    }

    public function removeCompany(Company $company): self
    {
        if ($this->companies->removeElement($company)) {
            // set the owning side to null (unless already changed)
            if ($company->getLanguage() === $this) {
                $company->setLanguage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Country>
     */
    public function getCountries(): Collection
    {
        return $this->countries;
    }

    public function addCountry(Country $country): self
    {
        if (!$this->countries->contains($country)) {
            $this->countries[] = $country;
            $country->setLanguage($this);
        }

        return $this;
    }

    public function removeCountry(Country $country): self
    {
        if ($this->countries->removeElement($country)) {
            // set the owning side to null (unless already changed)
            if ($country->getLanguage() === $this) {
                $country->setLanguage(null);
            }
        }

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
            $galleryImage->setLanguage($this);
        }

        return $this;
    }

    public function removeGalleryImage(GalleryImages $galleryImage): self
    {
        if ($this->galleryImages->removeElement($galleryImage)) {
            // set the owning side to null (unless already changed)
            if ($galleryImage->getLanguage() === $this) {
                $galleryImage->setLanguage(null);
            }
        }

        return $this;
    }

    
}
