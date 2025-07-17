<?php

namespace App\Currency\Application\Service\Abs;

interface CurrencyApiClientInterface
{
    public function sendRequest(): array;
}