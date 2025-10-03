<?php

declare(strict_types=1);

namespace Courier\Send\MessageRouting;

enum Method: string
{
    case ALL = 'all';

    case SINGLE = 'single';
}
