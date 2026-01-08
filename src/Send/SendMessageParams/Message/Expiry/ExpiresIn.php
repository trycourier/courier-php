<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams\Message\Expiry;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;

/**
 * Duration in ms or ISO8601 duration (e.g. P1DT4H).
 *
 * @phpstan-type ExpiresInVariants = string|int
 * @phpstan-type ExpiresInShape = ExpiresInVariants
 */
final class ExpiresIn implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['string', 'int'];
    }
}
