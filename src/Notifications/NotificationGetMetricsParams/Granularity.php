<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationGetMetricsParams;

/**
 * The size of each bucket in the series. Defaults to `DAY`. `WEEK` buckets start on Sunday. A fine granularity caps the window it can cover: `HOUR` spans at most 7 days and `DAY` at most 90 days, and a wider window returns `400` — request a coarser granularity instead. `WEEK` and `MONTH` are uncapped, subject to the 1000-bucket limit on a single response.
 */
enum Granularity: string
{
    case HOUR = 'HOUR';

    case DAY = 'DAY';

    case WEEK = 'WEEK';

    case MONTH = 'MONTH';
}
