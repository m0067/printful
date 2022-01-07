<?php

declare(strict_types=1);

namespace Dev\Printful\Tests;

use Dev\Printful\Command\AddPrintfulShippingOptionsCommand;
use PHPUnit\Framework\TestCase;

class PrintfulShippingOptionsTest extends TestCase
{
    public function testApiWithValidCache()
    {
        (new AddPrintfulShippingOptionsCommand)->execute();

        $this->assertFileExists();
    }
}
