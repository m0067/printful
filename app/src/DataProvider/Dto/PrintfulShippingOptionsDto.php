<?php

declare(strict_types=1);

namespace Dev\Printful\DataProvider\Dto;

class PrintfulShippingOptionsDto extends AbstractDto
{
    public PrintfulRecipientDto $recipient;
    /**
     * @var PrintfulItemDto[]
     */
    public array $items;
}
