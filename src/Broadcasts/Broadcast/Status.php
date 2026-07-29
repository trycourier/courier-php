<?php

declare(strict_types=1);

namespace Courier\Broadcasts\Broadcast;

/**
 * Lifecycle status of the broadcast.
 */
enum Status: string
{
    case DRAFT = 'draft';

    case SCHEDULED = 'scheduled';

    case SENDING = 'sending';

    case SENT = 'sent';
}
