<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;

/**
 * Represents a body of text to be rendered inside of the notification.
 *
 * @phpstan-import-type ElementalTextNodeWithTypeShape from \Courier\ElementalTextNodeWithType
 * @phpstan-import-type ElementalMetaNodeWithTypeShape from \Courier\ElementalMetaNodeWithType
 * @phpstan-import-type ElementalChannelNodeWithTypeShape from \Courier\ElementalChannelNodeWithType
 * @phpstan-import-type ElementalImageNodeWithTypeShape from \Courier\ElementalImageNodeWithType
 * @phpstan-import-type ElementalActionNodeWithTypeShape from \Courier\ElementalActionNodeWithType
 * @phpstan-import-type ElementalDividerNodeWithTypeShape from \Courier\ElementalDividerNodeWithType
 * @phpstan-import-type ElementalQuoteNodeWithTypeShape from \Courier\ElementalQuoteNodeWithType
 * @phpstan-import-type ElementalHTMLNodeWithTypeShape from \Courier\ElementalHTMLNodeWithType
 *
 * @phpstan-type ElementalNodeVariants = ElementalTextNodeWithType|ElementalMetaNodeWithType|ElementalChannelNodeWithType|ElementalImageNodeWithType|ElementalActionNodeWithType|ElementalDividerNodeWithType|ElementalQuoteNodeWithType|ElementalHTMLNodeWithType
 * @phpstan-type ElementalNodeShape = ElementalNodeVariants|ElementalTextNodeWithTypeShape|ElementalMetaNodeWithTypeShape|ElementalChannelNodeWithTypeShape|ElementalImageNodeWithTypeShape|ElementalActionNodeWithTypeShape|ElementalDividerNodeWithTypeShape|ElementalQuoteNodeWithTypeShape|ElementalHTMLNodeWithTypeShape
 */
final class ElementalNode implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            ElementalTextNodeWithType::class,
            ElementalMetaNodeWithType::class,
            ElementalChannelNodeWithType::class,
            ElementalImageNodeWithType::class,
            ElementalActionNodeWithType::class,
            ElementalDividerNodeWithType::class,
            ElementalQuoteNodeWithType::class,
            ElementalHTMLNodeWithType::class,
        ];
    }
}
