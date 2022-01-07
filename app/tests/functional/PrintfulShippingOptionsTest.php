<?php

declare(strict_types=1);

namespace Dev\Printful\Tests;

use Dev\Printful\Command\AddPrintfulShippingOptionsCommand;
use PHPUnit\Framework\TestCase;

class PrintfulShippingOptionsTest extends TestCase
{
    private const FILE_PATH = '/tmp/tests/dev-printful-cache/UQravgol7tMu2vs4jse+rijNQzc=';

    public function testApiWithCache(): void
    {
        (new AddPrintfulShippingOptionsCommand)->execute();

        $this->assertFileExists(self::FILE_PATH);
        $data = \json_decode($this->getActualOutputForAssertion(), true);
        $this->assertIsString($data[0]['id']);
        $this->assertIsString($data[0]['name']);
        $this->assertIsString($data[0]['rate']);
        $this->assertIsString($data[0]['currency']);
        $this->assertIsInt($data[0]['minDeliveryDays']);
        $this->assertIsInt($data[0]['maxDeliveryDays']);
    }

    public function testApiWithExpiredCache(): void
    {
        (new AddPrintfulShippingOptionsCommand)->execute();
        \sleep(4);
        (new AddPrintfulShippingOptionsCommand)->execute();

        $this->assertFileExists(self::FILE_PATH);
        $data = \json_decode(explode(PHP_EOL, $this->getActualOutputForAssertion())[1], true);
        $this->assertIsString($data[0]['id']);
        $this->assertIsString($data[0]['name']);
        $this->assertIsString($data[0]['rate']);
        $this->assertIsString($data[0]['currency']);
        $this->assertIsInt($data[0]['minDeliveryDays']);
        $this->assertIsInt($data[0]['maxDeliveryDays']);
    }

    protected function tearDown(): void
    {
        @\unlink(self::FILE_PATH);
    }
}
