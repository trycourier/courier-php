<?php

declare(strict_types=1);

namespace Courier\Send\Recipient\Preferences\Notification;

enum Status: string
{
    case OPTED_IN = 'OPTED_IN';

    case OPTED_OUT = 'OPTED_OUT';

    case REQUIRED = 'REQUIRED';
}
