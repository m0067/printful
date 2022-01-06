<?php

declare(strict_types=1);

namespace Dev\Printful\Cache;

use Dev\Printful\Marshaller\DefaultMarshaller;
use Dev\Printful\Marshaller\MarshallerInterface;

abstract class AbstractCache implements CacheInterface
{
    public function __construct(protected ?MarshallerInterface $marshaller = null)
    {
        $this->marshaller = $marshaller ?? new DefaultMarshaller();
    }
}
