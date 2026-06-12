<?php

declare(strict_types=1);

namespace Courier\Digests\DigestInstance;

/**
 * The status of the digest instance. `IN_PROGRESS` instances are still accumulating events; `COMPLETED` instances have been released.
 */
enum Status: string
{
    case IN_PROGRESS = 'IN_PROGRESS';

    case COMPLETED = 'COMPLETED';
}
