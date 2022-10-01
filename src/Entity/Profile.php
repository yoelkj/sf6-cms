<?php

namespace App\Entity;

use App\Repository\ProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfileRepository::class)]
class Profile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $roleUser;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $roleAdmin;

    #[ORM\OneToMany(mappedBy: 'profile', targetEntity: User::class)]
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
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

    public function isRoleUser(): ?bool
    {
        return $this->roleUser;
    }

    public function setRoleUser(?bool $roleUser): self
    {
        $this->roleUser = $roleUser;

        return $this;
    }

    public function isRoleAdmin(): ?bool
    {
        return $this->roleAdmin;
    }

    public function setRoleAdmin(?bool $roleAdmin): self
    {
        $this->roleAdmin = $roleAdmin;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setProfile($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getProfile() === $this) {
                $user->setProfile(null);
            }
        }

        return $this;
    }
}
