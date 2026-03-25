<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationListResponse;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\Notifications\NotificationListResponse\Result\Notification;
use Courier\Notifications\NotificationTemplateSummary;

/**
 * V2 (CDS) template summary returned in list responses.
 *
 * @phpstan-import-type NotificationShape from \Courier\Notifications\NotificationListResponse\Result\Notification
 * @phpstan-import-type NotificationTemplateSummaryShape from \Courier\Notifications\NotificationTemplateSummary
 *
 * @phpstan-type ResultVariants = Notification|NotificationTemplateSummary
 * @phpstan-type ResultShape = ResultVariants|NotificationShape|NotificationTemplateSummaryShape
 */
final class Result implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [Notification::class, NotificationTemplateSummary::class];
    }
}
