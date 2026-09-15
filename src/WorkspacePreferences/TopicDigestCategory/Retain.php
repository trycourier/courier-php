<?php

declare(strict_types=1);

namespace Courier\WorkspacePreferences\TopicDigestCategory;

/**
 * Which collected events survive the `limit`. `FIRST` and `LOWEST` keep the earliest or smallest; `LAST` and `HIGHEST` keep the latest or largest. Accepted case-insensitively, returned uppercase.
 */
enum Retain: string
{
    case FIRST = 'FIRST';

    case LAST = 'LAST';

    case HIGHEST = 'HIGHEST';

    case LOWEST = 'LOWEST';

    case NONE = 'NONE';
}
