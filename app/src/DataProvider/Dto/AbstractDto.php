<?php

declare(strict_types=1);

namespace Dev\Printful\DataProvider\Dto;

class AbstractDto
{
    public function toArray(): array
    {
        return (array)$this;
    }
}