<?php

declare(strict_types=1);

namespace Dev\Printful\DataProvider\Api;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class PrintfulClientFactory
{
    private const API_KEY = '77qn9aax-qrrm-idki:lnh0-fm2nhmp0yca7';
    private const BASE_URI = 'https://api.printful.com';

    public static function create(): Client
    {
        return new Client([
            RequestOptions::HEADERS => [
                'Authorization' => 'Basic '.base64_encode(self::API_KEY),
            ],
            'base_uri' => self::BASE_URI,
        ]);
    }
}
