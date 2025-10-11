<?php

declare(strict_types=1);

namespace Courier;

enum ChannelClassification: string
{
    case DIRECT_MESSAGE = 'direct_message';

    case EMAIL = 'email';

    case PUSH = 'push';

    case SMS = 'sms';

    case WEBHOOK = 'webhook';

    case INBOX = 'inbox';
}
