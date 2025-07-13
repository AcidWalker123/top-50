<?php

namespace App\Service\Dtos;

class CurrencyDto implements \JsonSerializable
{
    public string $ticker;
    public string $price;
    public string $change24h;
    public string $marketCap;
    public string $volume24h;
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
    public function __construct(
        string $ticker,
        string $price,
        string $change24h,
        string $marketCap,
        string $volume24h,
    ) {
        $this->ticker = $ticker;
        $this->price = $price;
        $this->change24h = $change24h;
        $this->marketCap = $marketCap;
        $this->volume24h = $volume24h;
    }
}
