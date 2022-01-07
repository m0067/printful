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

    public function toArray(): array
    {
        $items = [];

        foreach ($this->items as $item) {
            $items[] = $item->toArray();
        }

        return [
            'recipient' => $this->recipient->toArray(),
            'items' => $items,
        ];
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        return $this->recipient.\implode('', $this->items);
    }
}
