<?php

declare(strict_types=1);

namespace Dev\Printful\DataProvider\Dto;

class PrintfulItemDto extends AbstractDto
{
    public int $quantity;
    public int $variant_id;
}
