<?php
namespace App\Service;

use App\Service\Abs\CurrencyApiClientInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class CurrencyApiManager implements CurrencyApiClientInterface
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function sendRequest(): array
    {
        try {
            $response = $this->client->request('GET', $_ENV['API_URL'] ?? null, [
                'headers' => [
                    'X-CMC_PRO_API_KEY' => $_ENV['CMC_PRO_API_KEY'] ?? null,
                    'Accept' => 'application/json',
                ],
                'query' => [
                    'start' => 1,
                    'limit' => 50,
                    'convert' => 'USD',
                ],
            ]);

            $statusCode = $response->getStatusCode();

            if ($statusCode !== 200) {
                throw new \RuntimeException("API returned status code $statusCode");
            }

            $content = $response->getContent();
            $data = json_decode($content, true);

            return $data['data'] ?? [];

        } catch (TransportExceptionInterface $e) {
            throw new \RuntimeException('HTTP request failed: ' . $e->getMessage());
        }
    }
}
