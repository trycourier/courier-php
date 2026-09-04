<?php

declare(strict_types=1);

namespace Courier\Users\Tokens\TokenAddSingleParams;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;

/**
 * When the token expires. Accepts a date, or the boolean `false` to disable expiration entirely. ISO 8601 is recommended (for example `2026-10-25T00:00:00.000Z`). A value that cannot be parsed as a date is rejected; it is not treated as "no expiration" and does not fall back to the default. `true` is not a supported value. Omit the field to use the default, which expires a token that has not been re-registered for 60 days.
 *
 * @phpstan-type ExpiryDateVariants = string|bool
 * @phpstan-type ExpiryDateShape = ExpiryDateVariants
 */
final class ExpiryDate implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['string', 'bool'];
    }
}
