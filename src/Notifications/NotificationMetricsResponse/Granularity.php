<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationMetricsResponse;

/**
 * Bucket size the series was built at.
 */
enum Granularity: string
{
    case HOUR = 'HOUR';

    case DAY = 'DAY';

    case WEEK = 'WEEK';

    case MONTH = 'MONTH';
}
