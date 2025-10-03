<?php

declare(strict_types=1);

namespace Courier\Send\SendSendMessageParams\Message\To\UnionMember0\Preferences\Notification;

enum Source: string
{
    case SUBSCRIPTION = 'subscription';

    case LIST = 'list';

    case RECIPIENT = 'recipient';
}
