<?php

namespace App\Currency\Web\Controller;

use App\Currency\Application\Service\Abs\CurrencyServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class CurrencyController extends AbstractController
{
    private CurrencyServiceInterface $currencyService;
    public function __construct(CurrencyServiceInterface $currencyService) {
        $this->currencyService = $currencyService;
    }

    #[Route('/currency', name: 'app_currency')]
    public function index(SerializerInterface $serializer): JsonResponse
    {
        $currencies = $this->currencyService->getAllCurrencies();
        $json = $serializer->serialize($currencies, 'json');
        return new JsonResponse($json, 200, [], true);
    }
}
