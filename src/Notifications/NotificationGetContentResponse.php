<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;

/**
 * Elemental content response for V2 templates. Contains versioned elements with content checksums.
 *
 * @phpstan-import-type NotificationContentGetResponseShape from \Courier\Notifications\NotificationContentGetResponse
 * @phpstan-import-type NotificationGetContentShape from \Courier\Notifications\NotificationGetContent
 *
 * @phpstan-type NotificationGetContentResponseVariants = NotificationContentGetResponse|NotificationGetContent
 * @phpstan-type NotificationGetContentResponseShape = NotificationGetContentResponseVariants|NotificationContentGetResponseShape|NotificationGetContentShape
 */
final class NotificationGetContentResponse implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            NotificationContentGetResponse::class, NotificationGetContent::class,
        ];
    }
}
