<?php

declare(strict_types=1);

namespace Courier\MultipleTokens;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\Core\Conversion\ListOf;

/**
 * One device token, or an array of them. The values are the token strings themselves — not objects.
 *
 * @phpstan-type TokensVariants = string|list<string>
 * @phpstan-type TokensShape = TokensVariants
 */
final class Tokens implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['string', new ListOf('string')];
    }
}
