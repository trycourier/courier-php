<?php

declare(strict_types=1);

namespace Courier\Notifications\BaseCheck;

enum Status: string
{
    case RESOLVED = 'RESOLVED';

    case FAILED = 'FAILED';

    case PENDING = 'PENDING';
}
