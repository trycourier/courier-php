<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke;

enum MergeAlgorithm: string
{
    case REPLACE = 'replace';

    case NONE = 'none';

    case OVERWRITE = 'overwrite';

    case SOFT_MERGE = 'soft-merge';
}
