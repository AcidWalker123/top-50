<?php

namespace App\Service\Abs;

interface CurrencyApiClientInterface
{
    public function sendRequest(): array;
}