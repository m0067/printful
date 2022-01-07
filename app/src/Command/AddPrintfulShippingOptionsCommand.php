<?php

declare(strict_types=1);

namespace Dev\Printful\Command;

use Dev\Printful\DataProvider\Dto\PrintfulItemDto;
use Dev\Printful\DataProvider\Dto\PrintfulRecipientDto;
use Dev\Printful\DataProvider\Dto\PrintfulShippingOptionsDto;
use Dev\Printful\Service\PrintfulService;

class AddPrintfulShippingOptionsCommand implements CommandInterface
{
    public static function getName(): string
    {
        return 'add-printful-shipping-options';
    }

    public function execute(): void
    {
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
        $result = (new PrintfulService)->listShippingOptions($shippingOptionsDto);

        echo \json_encode($result).PHP_EOL;
    }
}
