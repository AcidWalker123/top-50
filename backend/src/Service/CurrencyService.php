<?php

namespace App\Service;

use App\Repository\CurrencyRepository;
use App\Service\Abs\CurrencyServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Currency;
use App\Service\Mappers\CurrencyMapper;
use Psr\Cache\CacheItemPoolInterface;

class CurrencyService implements CurrencyServiceInterface
{
    private const CACHE_KEY = 'currency.all';
    private CurrencyRepository $currencyRepository;
    private CurrencyApiManager $request;
    private EntityManagerInterface $entityManager;
    private CacheItemPoolInterface $currencyCache;

    public function __construct(
        CurrencyRepository $currencyRepository,
        CurrencyApiManager $request,
        EntityManagerInterface $entityManager,
        CacheItemPoolInterface $currencyCache
    )
    {
        $this->currencyRepository = $currencyRepository;
        $this->request = $request;
        $this->entityManager = $entityManager;
        $this->currencyCache = $currencyCache;
    }

    public function getAllCurrencies(): array
    {
        $item = $this->currencyCache->getItem(self::CACHE_KEY);

        if (!$item->isHit()) {
            $currencies = $this->currencyRepository->findAll();

            if (empty($currencies)) {
                $this->fetchAndUpdateCurrencies();
                $currencies = $this->currencyRepository->findAll();
            }

            $dtos = array_map(fn(Currency $currency) => CurrencyMapper::toDto($currency), $currencies);

            $item->set($dtos);
            $item->expiresAfter(3600);
            $this->currencyCache->save($item);
        }

        return $item->get();
    }

    public function fetchAndUpdateCurrencies(): void
    {
        $currenciesData = $this->request->sendRequest();
        $this->entityManager->beginTransaction();

        try {
            foreach ($currenciesData as $data) {
                $currency = $this->currencyRepository->findOneBy(['ticker' => $data['symbol']])
                    ?? new Currency();
                $currency->setTicker($data['symbol']);
                $currency->setPrice($data['quote']['USD']['price']);
                $currency->setChange24h($data['quote']['USD']['volume_change_24h']);
                $currency->setMarketCap($data['quote']['USD']['market_cap']);
                $currency->setVolume24h($data['quote']['USD']['volume_24h']);
                $currency->setLastUpdated(new \DateTimeImmutable($data['quote']['USD']['last_updated']));

                $this->entityManager->persist($currency);
            }

            $this->entityManager->flush();
            $this->entityManager->commit();
            
            $this->currencyCache->deleteItem(self::CACHE_KEY);

        } catch (\Throwable $e) {
            $this->entityManager->rollback();    
            throw $e;                            
        }
    }
}