<?php

declare(strict_types=1);

namespace Courier\MessageRouting;

enum Method: string
{
    case ALL = 'all';

    case SINGLE = 'single';
}
