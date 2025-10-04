<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams\Message\Routing;

enum Method: string
{
    case ALL = 'all';

    case SINGLE = 'single';
}
