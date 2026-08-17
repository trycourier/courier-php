<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;

/**
 * Apple Push Notification device tokens. Supply either a single `token` or a `tokens` value. A bare string is rejected by the provider — the token must be wrapped in this object.
 *
 * @phpstan-import-type TokenShape from \Courier\Token
 * @phpstan-import-type MultipleTokensShape from \Courier\MultipleTokens
 *
 * @phpstan-type ApnVariants = Token|MultipleTokens
 * @phpstan-type ApnShape = ApnVariants|TokenShape|MultipleTokensShape
 */
final class Apn implements ConverterSource
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
