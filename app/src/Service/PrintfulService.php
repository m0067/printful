<?php

declare(strict_types=1);

namespace Dev\Printful\Service;

use Dev\Printful\Cache\FileCache;
use Dev\Printful\DataProvider\Api\PrintfulApi;
use Dev\Printful\DataProvider\Dto\PrintfulItemDto;
use Dev\Printful\DataProvider\Dto\PrintfulRecipientDto;
use Dev\Printful\DataProvider\Dto\PrintfulShippingOptionsDto;

class PrintfulService
{
    public function listShippingOptions(): array
    {
        $fileCache = new FileCache();
        $api = new PrintfulApi($fileCache);
        $itemDto = new PrintfulItemDto;
        $itemDto->variant_id = 7679;
        $itemDto->quantity = 2;
        $recipientDto = new PrintfulRecipientDto;
        $recipientDto->address1 = '11025 Westlake Dr';
        $recipientDto->city = 'Charlotte';
        $recipientDto->country_code = 'US';
        $recipientDto->state_code = 'NC';
        $recipientDto->zip = 28273;
        $shippingOptionsDto = new PrintfulShippingOptionsDto;
        $shippingOptionsDto->recipient = $recipientDto;
        $shippingOptionsDto->items = [$itemDto];

        return $api->fetchShippingOptions($shippingOptionsDto);
    }
}
