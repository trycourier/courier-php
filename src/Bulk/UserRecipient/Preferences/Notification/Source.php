<?php

declare(strict_types=1);

namespace Courier\Bulk\UserRecipient\Preferences\Notification;

enum Source: string
{
    case SUBSCRIPTION = 'subscription';

    case LIST = 'list';

    case RECIPIENT = 'recipient';
}
