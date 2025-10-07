<?php

declare(strict_types=1);

namespace Courier\Notifications\MessageRouting;

enum Method: string
{
    case ALL = 'all';

    case SINGLE = 'single';
}
