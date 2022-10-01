<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

use Scheb\TwoFactorBundle\Model\Totp\TwoFactorInterface;
use Scheb\TwoFactorBundle\Model\Totp\TotpConfigurationInterface;
use Scheb\TwoFactorBundle\Model\Totp\TotpConfiguration;

use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements TimestampableInterface, UserInterface, PasswordAuthenticatedUserInterface, TwoFactorInterface
{   
    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups("user:read")]
    private $id;

    #[Groups("user:read")]
    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[Groups("user:read")]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $password;

    #[ORM\Column(type: 'string', length: 255, nullable:true)]
    private $totpSecret;

    private $plainPassword;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $avatar;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isActive = false;

    #[ORM\ManyToOne(targetEntity: Profile::class, inversedBy: 'users')]
    private $profile;

    public function __toString(): string
    {
        return ($this->name)?$this->name:$this->email;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRoles(): array{
        
        $arr_roles = [];
        $obj_role = $this->getProfile();
        
        if($obj_role){
            if($obj_role->isRoleUser()) $arr_roles[] = 'ROLE_USER'; 
            if($obj_role->isRoleAdmin()) $arr_roles[] = 'ROLE_ADMIN'; 
        }
        return array_unique($arr_roles);
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
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

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }
    
    public function setPassword($password): self
    {

        if (!is_null($password)) {
            $this->password = $password;
        }

        //$this->password = $password;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }
    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    #[Groups("user:read")]
    public function getAvatarUri(int $size = 32): string
    {
        return 'https://ui-avatars.com/api/?' . http_build_query([
            'name' => $this->getDisplayName() ?: $this->getEmail(),
            'size' => $size,
            'background' => 'random',
        ]);
    }

    public function getDisplayName(): string
    {
        return $this->getName() ?: $this->getEmail();
    }

    public function getIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    
    public function isTotpAuthenticationEnabled(): bool
    {
        return $this->totpSecret ? true : false;
    }
    public function getTotpAuthenticationUsername(): string
    {
        return $this->getUserIdentifier();
    }
    public function getTotpAuthenticationConfiguration(): ?TotpConfigurationInterface
    {
        return new TotpConfiguration($this->totpSecret, TotpConfiguration::ALGORITHM_SHA1, 30, 6);
    }
    

    public function getTotpSecret(): ?string
    {
        return $this->totpSecret;
    }
    public function setTotpSecret(?string $totpSecret): self
    {
        $this->totpSecret = $totpSecret;
        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function getAvatarUrl(): ?string
    {
        if (!$this->avatar) {
            return null;
        }

        if (strpos($this->avatar, '/') !== false) {
            return $this->avatar;
        }

        return sprintf('/uploads/avatars/%s', $this->avatar);
    }

    public function setAvatar(?string $avatar): void
    {
        $this->avatar = $avatar;
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

    public function getProfile(): ?Profile
    {
        return $this->profile;
    }

    public function setProfile(?Profile $profile): self
    {
        $this->profile = $profile;

        return $this;
    }

}
