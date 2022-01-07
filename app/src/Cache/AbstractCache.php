<?php

declare(strict_types=1);

namespace Dev\Printful\Cache;

use Dev\Printful\Cache\Marshaller\DefaultMarshaller;
use Dev\Printful\Cache\Marshaller\MarshallerInterface;

abstract class AbstractCache implements CacheInterface
{
    public function __construct(private ?MarshallerInterface $marshaller = null)
    {
        $this->marshaller = $marshaller ?? new DefaultMarshaller();
    }

    /**
     * @inheritDoc
     */
    public function set(string $key, $value, int $duration): self
    {
        if (!(\is_scalar($value) || \is_array($value))) {
            throw new \InvalidArgumentException('$value should be scalar or array type.');
        }

        $data = $this->marshaller->marshal($value);

        return $this->doSet($key, $data, $duration);
    }

    /**
     * @inheritDoc
     */
    public function get(string $key): null|string
    {
        $value = $this->doGet($key);

        return \is_null($value) ? null : $this->marshaller->unmarshal($value);
    }

    abstract protected function doSet(string $key, string $marshalledData, int $duration): self;

    abstract protected function doGet(string $key): null|string;
}
