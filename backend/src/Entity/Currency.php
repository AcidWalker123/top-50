<?php

namespace App\Entity;

use App\Repository\CurrencyRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CurrencyRepository::class)]
class Currency
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $ticker = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 18, scale: 8)]
    private ?string $price = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 4)]
    private ?string $change24h = null;

   #[ORM\Column(type: Types::DECIMAL, precision: 24, scale: 2)]
    private ?string $marketCap = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 24, scale: 2)]
    private ?string $volume24h = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $lastUpdated = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTicker(): ?string
    {
        return $this->ticker;
    }

    public function setTicker(string $ticker): static
    {
        $this->ticker = $ticker;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getChange24h(): ?string
    {
        return $this->change24h;
    }

    public function setChange24h(string $change24h): static
    {
        $this->change24h = $change24h;

        return $this;
    }

    public function getMarketCap(): ?string
    {
        return $this->marketCap;
    }

    public function setMarketCap(string $marketCap): static
    {
        $this->marketCap = $marketCap;

        return $this;
    }

    public function getVolume24h(): ?string
    {
        return $this->volume24h;
    }

    public function setVolume24h(string $volume24h): static
    {
        $this->volume24h = $volume24h;

        return $this;
    }

    public function getLastUpdated(): ?\DateTimeImmutable
    {
        return $this->lastUpdated;
    }

    public function setLastUpdated(\DateTimeImmutable $lastUpdated): static
    {
        $this->lastUpdated = $lastUpdated;

        return $this;
    }
}
