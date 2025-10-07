<?php

declare(strict_types=1);

namespace Courier\Send\Recipient\Preferences\Notification;

enum Source: string
{
    case SUBSCRIPTION = 'subscription';

    case LIST = 'list';

    case RECIPIENT = 'recipient';
}
