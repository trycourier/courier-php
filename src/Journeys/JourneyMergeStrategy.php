<?php

declare(strict_types=1);

namespace Courier\Journeys;

/**
 * Strategy for merging a fetch response into the journey run state.
 */
enum JourneyMergeStrategy: string
{
    case OVERWRITE = 'overwrite';

    case SOFT_MERGE = 'soft-merge';

    case REPLACE = 'replace';

    case NONE = 'none';
}
