<?php

namespace App\Service\Abs;
interface CurrencyServiceInterface
{
    public function getAllCurrencies(): array;

    public function fetchAndUpdateCurrencies(): void;
}