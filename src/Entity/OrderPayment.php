<?php

namespace App\Entity;

use App\Repository\OrderPaymentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderPaymentRepository::class)]
class OrderPayment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orderPayments')]
    private ?Order $orderHead = null;

    #[ORM\Column(nullable: true)]
    private ?int $paymentMethod = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $paymentCode = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $total = null;

    #[ORM\Column(nullable: true)]
    private ?int $status = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isActive = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderHead(): ?Order
    {
        return $this->orderHead;
    }

    public function setOrderHead(?Order $orderHead): static
    {
        $this->orderHead = $orderHead;

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

    public function getPaymentCode(): ?string
    {
        return $this->paymentCode;
    }

    public function setPaymentCode(?string $paymentCode): static
    {
        $this->paymentCode = $paymentCode;

        return $this;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(?string $total): static
    {
        $this->total = $total;

        return $this;
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
