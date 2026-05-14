<?php

declare(strict_types=1);

namespace Courier\Journeys;

enum JourneyMergeStrategy: string
{
    case OVERWRITE = 'overwrite';

    case SOFT_MERGE = 'soft-merge';

    case REPLACE = 'replace';

    case NONE = 'none';
}
