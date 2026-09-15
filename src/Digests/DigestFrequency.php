<?php

declare(strict_types=1);

namespace Courier\Digests;

/**
 * How often a digest is delivered. `instant` delivers immediately without batching, and is the one value that takes no `time`.
 */
enum DigestFrequency: string
{
    case INSTANT = 'instant';

    case DAILY = 'daily';

    case WEEKDAYS = 'weekdays';

    case WEEKLY = 'weekly';

    case CUSTOM_DAYS = 'custom_days';

    case MONTHLY = 'monthly';
}
