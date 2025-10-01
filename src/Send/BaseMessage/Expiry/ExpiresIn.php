<?php

declare(strict_types=1);

namespace Courier\Send\BaseMessage\Expiry;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;

/**
 * A duration in the form of milliseconds or an ISO8601 Duration format (i.e. P1DT4H).
 */
final class ExpiresIn implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
     */
    public static function variants(): array
    {
        return ['string', 'int'];
    }
}
