<?php

declare(strict_types=1);

namespace Dev\Printful\Command;

interface CommandInterface
{
    public static function getName(): string;

    public function execute(): void;
}
