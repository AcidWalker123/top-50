<?php

namespace App\Currency\Application\Service\Mappers;

use App\Currency\Domain\Entity\Currency;
use App\Currency\Application\Service\Dtos\CurrencyDto;

class CurrencyMapper
{
    public static function toDto(Currency $currency): CurrencyDto
    {
        return new CurrencyDto(
            $currency->getTicker(),
            $currency->getPrice(),
            $currency->getChange24h(),
            $currency->getMarketCap(),
            $currency->getVolume24h(),
        );
    }
}
