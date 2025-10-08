<?php

declare(strict_types=1);

namespace Courier\BaseCheck;

enum Status: string
{
    case RESOLVED = 'RESOLVED';

    case FAILED = 'FAILED';

    case PENDING = 'PENDING';
}
