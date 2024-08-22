<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $status = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isActive = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isDeleted = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(length: 5)]
    private ?string $currency = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $total = null;

    #[ORM\Column(nullable: true)]
    private ?int $paymentMethod = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDoc = null;

    #[ORM\OneToMany(mappedBy: 'orderHead', targetEntity: OrderDetail::class)]
    private Collection $orderDetails;

    #[ORM\OneToMany(mappedBy: 'orderHead', targetEntity: OrderPayment::class)]
    private Collection $orderPayments;

    public function __construct()
    {
        $this->orderDetails = new ArrayCollection();
        $this->orderPayments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(?bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function isIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(?bool $isDeleted): static
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(string $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function getPaymentMethod(): ?int
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(?int $paymentMethod): static
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    public function getDateDoc(): ?\DateTimeInterface
    {
        return $this->dateDoc;
    }

    public function setDateDoc(\DateTimeInterface $dateDoc): static
    {
        $this->dateDoc = $dateDoc;

        return $this;
    }

    /**
     * @return Collection<int, OrderDetail>
     */
    public function getOrderDetails(): Collection
    {
        return $this->orderDetails;
    }

    public function addOrderDetail(OrderDetail $orderDetail): static
    {
        if (!$this->orderDetails->contains($orderDetail)) {
            $this->orderDetails->add($orderDetail);
            $orderDetail->setOrderHead($this);
        }

        return $this;
    }

    public function removeOrderDetail(OrderDetail $orderDetail): static
    {
        if ($this->orderDetails->removeElement($orderDetail)) {
            // set the owning side to null (unless already changed)
            if ($orderDetail->getOrderHead() === $this) {
                $orderDetail->setOrderHead(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OrderPayment>
     */
    public function getOrderPayments(): Collection
    {
        return $this->orderPayments;
    }

    public function addOrderPayment(OrderPayment $orderPayment): static
    {
        if (!$this->orderPayments->contains($orderPayment)) {
            $this->orderPayments->add($orderPayment);
            $orderPayment->setOrderHead($this);
        }

        return $this;
    }

    public function removeOrderPayment(OrderPayment $orderPayment): static
    {
        if ($this->orderPayments->removeElement($orderPayment)) {
            // set the owning side to null (unless already changed)
            if ($orderPayment->getOrderHead() === $this) {
                $orderPayment->setOrderHead(null);
            }
        }

        return $this;
    }
}
