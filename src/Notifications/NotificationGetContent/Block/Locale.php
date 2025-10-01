<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationGetContent\Block;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\Notifications\NotificationGetContent\Block\Locale\NotificationContentHierarchy;

final class Locale implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
     */
    public static function variants(): array
    {
        return ['string', NotificationContentHierarchy::class];
    }
}
