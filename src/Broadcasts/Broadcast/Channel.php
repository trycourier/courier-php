<?php

declare(strict_types=1);

namespace Courier\Broadcasts\Broadcast;

/**
 * The broadcast's delivery channel.
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
