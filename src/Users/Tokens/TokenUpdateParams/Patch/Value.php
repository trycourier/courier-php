<?php

declare(strict_types=1);

namespace Courier\Users\Tokens\TokenUpdateParams\Patch;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\Core\Conversion\MapOf;

/**
 * The value for the operation. A string for most fields; boolean `false` when disabling token expiration via `expiry_date`, which cannot be expressed as a string.
 *
 * @phpstan-type ValueVariants = string|bool|array<string,mixed>
 * @phpstan-type ValueShape = ValueVariants
 */
final class Value implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['string', 'bool', new MapOf('mixed')];
    }
}
