<?php

namespace App\Entity;

use App\Repository\PageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;
use Symfony\Component\Intl\Locale;

#[ORM\Entity(repositoryClass: PageRepository::class)]
class Page implements TimestampableInterface,  TranslatableInterface
{
    use TimestampableTrait;
    use TranslatableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $bgImage;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $orderRow;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isCore = false;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isActive = false;
    
    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isCatalog;

    #[ORM\ManyToOne(targetEntity: Gallery::class, inversedBy: 'pages')]
    private $gallery;

    #[ORM\ManyToMany(targetEntity: Widget::class, inversedBy: 'pages')]
    #[ORM\OrderBy(['orderRow'=> "ASC"])]
    private $widgets;

    #[ORM\ManyToMany(targetEntity: Menu::class, mappedBy: 'pages')]
    private $menus;

    #[ORM\OneToMany(mappedBy: 'page', targetEntity: Menu::class)]
    private $singlemenus;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isHomepage = false;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $useContactForm = false;

    #[ORM\Column(nullable: true)]
    private ?bool $isLocalHomepage = null;

    #[ORM\ManyToOne(inversedBy: 'pages')]
    private ?Menu $menu = null;

    #[ORM\Column(nullable: true)]
    private ?bool $pullRightImage = null;

    public function __construct()
    {
        $this->widgets = new ArrayCollection();
        $this->menus = new ArrayCollection();
        $this->singlemenus = new ArrayCollection();
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBgImage(): ?string
    {
        return $this->bgImage;
    }

    public function getBgImageUrl(): ?string
    {
        if (!$this->bgImage) return null;
        if (strpos($this->bgImage, '/') !== false) return $this->bgImage;
        return sprintf('/uploads/pages/bg/%s', $this->bgImage);
    }

    public function setBgImage(?string $bgImage): self
    {
        $this->bgImage = $bgImage;

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

    public function getIsCatalog(): ?bool
    {
        return $this->isCatalog;
    }

    public function setIsCatalog(?bool $isCatalog): self
    {
        $this->isCatalog = $isCatalog;

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
     * @return Collection<int, Menu>
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menu $menu): self
    {
        if (!$this->menus->contains($menu)) {
            $this->menus[] = $menu;
            $menu->addPage($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        if ($this->menus->removeElement($menu)) {
            $menu->removePage($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Menu>
     */
    public function getSinglemenus(): Collection
    {
        return $this->singlemenus;
    }

    public function addSinglemenu(Menu $singlemenu): self
    {
        if (!$this->singlemenus->contains($singlemenu)) {
            $this->singlemenus[] = $singlemenu;
            $singlemenu->setPage($this);
        }

        return $this;
    }

    public function removeSinglemenu(Menu $singlemenu): self
    {
        if ($this->singlemenus->removeElement($singlemenu)) {
            // set the owning side to null (unless already changed)
            if ($singlemenu->getPage() === $this) {
                $singlemenu->setPage(null);
            }
        }

        return $this;
    }

    public function isIsHomepage(): ?bool
    {
        return $this->isHomepage;
    }

    public function setIsHomepage(?bool $isHomepage): self
    {
        $this->isHomepage = $isHomepage;

        return $this;
    }

    public function isUseContactForm(): ?bool
    {
        return $this->useContactForm;
    }

    public function setUseContactForm(?bool $useContactForm): self
    {
        $this->useContactForm = $useContactForm;

        return $this;
    }

    public function isIsLocalHomepage(): ?bool
    {
        return $this->isLocalHomepage;
    }

    public function setIsLocalHomepage(?bool $isLocalHomepage): self
    {
        $this->isLocalHomepage = $isLocalHomepage;

        return $this;
    }

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): self
    {
        $this->menu = $menu;

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

    
}
