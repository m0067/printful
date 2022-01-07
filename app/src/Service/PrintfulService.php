<?php

declare(strict_types=1);

namespace Dev\Printful\Service;

use Dev\Printful\Cache\FileCache;
use Dev\Printful\DataProvider\Api\PrintfulApi;
use Dev\Printful\DataProvider\Dto\PrintfulShippingOptionsDto;

class PrintfulService
{
    private PrintfulApi $api;

    public function __construct()
    {
        $this->api = new PrintfulApi(new FileCache);
    }

    public function listShippingOptions(PrintfulShippingOptionsDto $shippingOptionsDto): array
    {
        return $this->api->fetchShippingOptions($shippingOptionsDto);
    }
}
