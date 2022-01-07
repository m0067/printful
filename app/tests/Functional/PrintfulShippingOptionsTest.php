<?php

declare(strict_types=1);

namespace Dev\Printful\Tests\Functional;

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
        $this->assertDataTypeStructure($data[0]);
    }

    public function testApiWithExpiredCache(): void
    {
        (new AddPrintfulShippingOptionsCommand)->execute();
        $expiratedAt = $this->getExpiresAt(self::FILE_PATH);
        \sleep(3);
        (new AddPrintfulShippingOptionsCommand)->execute();
        $newExpiresAt = $this->getExpiresAt(self::FILE_PATH);

        $this->assertGreaterThan($expiratedAt, $newExpiresAt);
        $data = \json_decode(explode(PHP_EOL, $this->getActualOutputForAssertion())[1], true);
        $this->assertDataTypeStructure($data[0]);
    }

    protected function tearDown(): void
    {
        @\unlink(self::FILE_PATH);
    }

    private function assertDataTypeStructure(array $data): void
    {
        $this->assertIsString($data['id']);
        $this->assertIsString($data['name']);
        $this->assertIsString($data['rate']);
        $this->assertIsString($data['currency']);
        $this->assertIsInt($data['minDeliveryDays']);
        $this->assertIsInt($data['maxDeliveryDays']);
    }

    private function getExpiresAt(string $filePath): int
    {
        $handle = @\fopen($filePath, 'r');
        $expiresAt = (int)\fgets($handle);
        \fclose($handle);

        return $expiresAt;
    }
}
