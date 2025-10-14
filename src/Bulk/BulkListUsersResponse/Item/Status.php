<?php

declare(strict_types=1);

namespace Courier\Bulk\BulkListUsersResponse\Item;

enum Status: string
{
    case PENDING = 'PENDING';

    case ENQUEUED = 'ENQUEUED';

    case ERROR = 'ERROR';
}
