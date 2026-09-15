<?php

declare(strict_types=1);

namespace Courier\Digests;

/**
 * A day of the week. Accepted case-insensitively, returned lowercase.
 */
enum DigestDayOfWeek: string
{
    case SUNDAY = 'sunday';

    case MONDAY = 'monday';

    case TUESDAY = 'tuesday';

    case WEDNESDAY = 'wednesday';

    case THURSDAY = 'thursday';

    case FRIDAY = 'friday';

    case SATURDAY = 'saturday';
}
