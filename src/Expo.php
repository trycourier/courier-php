<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-import-type TokenShape from \Courier\Token
 * @phpstan-import-type MultipleTokensShape from \Courier\MultipleTokens
 *
 * @phpstan-type ExpoVariants = Token|MultipleTokens
 * @phpstan-type ExpoShape = ExpoVariants|TokenShape|MultipleTokensShape
 */
final class Expo implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [Token::class, MultipleTokens::class];
    }
}
