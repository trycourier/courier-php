<?php

declare(strict_types=1);

namespace Courier\Bulk\BulkGetJobResponse\Job;

enum Status: string
{
    case CREATED = 'CREATED';

    case PROCESSING = 'PROCESSING';

    case COMPLETED = 'COMPLETED';

    case ERROR = 'ERROR';
}
