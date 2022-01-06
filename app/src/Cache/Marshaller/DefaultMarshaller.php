<?php

declare(strict_types=1);

namespace Dev\Printful\Marshaller;

class DefaultMarshaller implements MarshallerInterface
{
    public function marshal(mixed $value): string
    {
        return \serialize($value);
    }

    public function unmarshal(string $value): mixed
    {
        return \unserialize($value);
    }
}
