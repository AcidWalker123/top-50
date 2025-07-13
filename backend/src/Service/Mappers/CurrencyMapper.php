<?php

namespace App\Service\Mappers;

use App\Entity\Currency;
use App\Service\Dtos\CurrencyDto;

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
