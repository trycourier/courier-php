<?php

declare(strict_types=1);

namespace Courier\Audiences;

use Courier\Audiences\FilterConfig\UnionMember0;
use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;

/**
 * The operator to use for filtering.
 */
final class FilterConfig implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
     */
    public static function variants(): array
    {
        return [UnionMember0::class, NestedFilterConfig::class];
    }
}
