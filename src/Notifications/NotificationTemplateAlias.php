<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\Core\Conversion\ListOf;

/**
 * A template's send-time alias as returned by a read, omitted entirely when it has none. Usually a single string; an array for a template that resolves from several aliases, which writes through this API can no longer produce — only templates predating that restriction, or aliases attached outside this API, hold more than one.
 *
 * @phpstan-type NotificationTemplateAliasVariants = string|list<string>
 * @phpstan-type NotificationTemplateAliasShape = NotificationTemplateAliasVariants
 */
final class NotificationTemplateAlias implements ConverterSource
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
