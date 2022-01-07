<?php

declare(strict_types=1);

namespace Dev\Printful\DataProvider\Api;

use Dev\Printful\Cache\CacheInterface;
use Dev\Printful\DataProvider\Dto\PrintfulShippingOptionsDto;
use GuzzleHttp\Client;
use GuzzleHttp\Utils;

class PrintfulApi
{
    private const CACHE_PREFIX = 'pf_api_';
    private const CACHE_DURATION = 300;
    private Client $client;

    public function __construct(protected CacheInterface $cache)
    {
        $this->client = PrintfulClientFactory::create();
    }

    public function fetchShippingOptions(PrintfulShippingOptionsDto $dto): array
    {
        $key = self::CACHE_PREFIX.sha1((string)$dto);
        $data = $this->cache->get($key);

        if (\is_null($data)) {
            $response = $this->client->post(
                '/shipping/rates',
                [
                    'json' => $dto->toArray(),
                ]
            );

            $data = Utils::jsonDecode((string)$response->getBody(), true)['result'];
            $this->cache->set($key, $data, self::CACHE_DURATION);
        }

        return $data;
    }
}
