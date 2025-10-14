<?php

declare(strict_types=1);

namespace Courier\Core\Conversion;

use Courier\Core\Conversion\Concerns\ArrayOf;
use Courier\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class ListOf implements Converter
{
    use ArrayOf;

    private function empty(): array|object // @phpstan-ignore-line
    {
        return [];
    }
}
