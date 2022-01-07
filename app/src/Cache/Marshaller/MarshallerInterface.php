<?php

declare(strict_types=1);

namespace Dev\Printful\Cache\Marshaller;

interface MarshallerInterface
{
    /**
     * Serializes value
     *
     * @throws \Exception Whenever serialization fails
     */
    public function marshal(mixed $value): string;

    /**
     * Unserializes value
     *
     * @throws \Exception Whenever unserialization fails
     */
    public function unmarshal(string $value): mixed;
}
