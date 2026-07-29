<?php

declare(strict_types=1);

namespace Courier\Broadcasts\BroadcastCreateParams;

/**
 * The single delivery channel for this broadcast.
 */
enum Channel: string
{
    case EMAIL = 'email';

    case SMS = 'sms';

    case PUSH = 'push';

    case INBOX = 'inbox';

    case SLACK = 'slack';

    case MSTEAMS = 'msteams';
}
