<?php

declare(strict_types=1);

namespace Dev\Printful\Command;

use Dev\Printful\Cache\FileCache;
use Dev\Printful\DataProvider\Api\PrintfulApi;
use Dev\Printful\DataProvider\Dto\PrintfulItemDto;
use Dev\Printful\DataProvider\Dto\PrintfulRecipientDto;
use Dev\Printful\DataProvider\Dto\PrintfulShippingOptionsDto;
use Dev\Printful\Marshaller\DefaultMarshaller;

class AddPrintfulShippingOptionsCommand implements CommandInterface
{

    public static function getName(): string
    {
        return 'add-printful-shipping-options';
    }

    public function execute(): void
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
        $result = $api->fetchShippingOptions($shippingOptionsDto);

        var_dump($result);
    }
}
