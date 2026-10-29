<?php

declare(strict_types=1);

namespace Courier\Providers\ProviderPatchParams\Patch;

/**
 * The operation to perform.
 */
enum Op: string
{
    case ADD = 'add';

    case REMOVE = 'remove';

    case REPLACE = 'replace';

    case MOVE = 'move';

    case COPY = 'copy';

    case TEST = 'test';
}
