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

    // @phpstan-ignore-next-line missingType.iterableValue
    private function empty(): array|object
    {
        return [];
    }
}
