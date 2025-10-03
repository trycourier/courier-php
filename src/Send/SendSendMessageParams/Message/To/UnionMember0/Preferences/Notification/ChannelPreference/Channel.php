<?php

declare(strict_types=1);

namespace Courier\Send\SendSendMessageParams\Message\To\UnionMember0\Preferences\Notification\ChannelPreference;

enum Channel: string
{
    case DIRECT_MESSAGE = 'direct_message';

    case EMAIL = 'email';

    case PUSH = 'push';

    case SMS = 'sms';

    case WEBHOOK = 'webhook';

    case INBOX = 'inbox';
}
