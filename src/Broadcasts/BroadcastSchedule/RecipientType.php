<?php

declare(strict_types=1);

namespace Courier\Broadcasts\BroadcastSchedule;

/**
 * Whether the broadcast targets a list or an audience.
 */
enum RecipientType: string
{
    case LIST = 'list';

    case AUDIENCE = 'audience';
}
