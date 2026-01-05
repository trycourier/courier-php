<?php

declare(strict_types=1);

namespace Courier\Audiences;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;

/**
 * A single filter to use for filtering.
 *
 * @phpstan-import-type SingleFilterConfigShape from \Courier\Audiences\SingleFilterConfig
 *
 * @phpstan-type FilterConfigShape = SingleFilterConfigShape|NestedFilterConfig
 */
final class FilterConfig implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [SingleFilterConfig::class, NestedFilterConfig::class];
    }
}
