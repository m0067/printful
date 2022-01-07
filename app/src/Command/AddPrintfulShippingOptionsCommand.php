<?php

declare(strict_types=1);

namespace Dev\Printful\Command;

class AddPrintfulShippingOptionsCommand implements CommandInterface
{

    public static function getName(): string
    {
        return 'add-printful-shipping-options';
    }

    public function execute(): void
    {
        echo 123123;
    }
}
