<?php

declare(strict_types=1);

namespace Dev\Printful\DataProvider\Api;

use Dev\Printful\Cache\CacheInterface;
use Dev\Printful\DataProvider\Dto\PrintfulShippingOptionsDto;
use GuzzleHttp\Client;

class PrintfulApi
{
    private Client $client;

    public function __construct(protected CacheInterface $cache)
    {
        $this->client = PrintfulClientFactory::create();
    }

    public function fetchShippingOptions(PrintfulShippingOptionsDto $dto): array
    {
        $response = $this->client->post(
            '/shipping/rates',
            [
                'json' => $dto->toArray(),
            ]
        );

        $content = $response->json();

    }
}
