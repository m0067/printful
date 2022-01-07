<?php

declare(strict_types=1);

namespace Dev\Printful\Command;

use Dev\Printful\Service\PrintfulService;

class AddPrintfulShippingOptionsCommand implements CommandInterface
{
    public static function getName(): string
    {
        return 'add-printful-shipping-options';
    }

    public function execute(): void
    {
        $result = (new PrintfulService)->listShippingOptions();

        echo \json_encode($result).PHP_EOL;
    }
}
