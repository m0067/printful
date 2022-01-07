<?php

declare(strict_types=1);

namespace Dev\Printful\DataProvider\Dto;

class AbstractDto implements \Stringable
{
    public function toArray(): array
    {
        return (array)$this;
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        return \implode('', $this->toArray());
    }
}