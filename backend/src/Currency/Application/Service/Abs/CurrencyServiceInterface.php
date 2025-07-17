<?php

namespace App\Currency\Application\Service\Abs;
interface CurrencyServiceInterface
{
    public function getAllCurrencies(): array;

    public function fetchAndUpdateCurrencies(): void;
}