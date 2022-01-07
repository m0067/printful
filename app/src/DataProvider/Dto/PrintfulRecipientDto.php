<?php

declare(strict_types=1);

namespace Dev\Printful\DataProvider\Dto;

class PrintfulRecipientDto extends AbstractDto
{
    public string $address1;
    public string $city;
    public string $country_code;
    public string $state_code;
    public int $zip;
}
