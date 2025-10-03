<?php

declare(strict_types=1);

namespace Courier\Send\SendSendMessageParams\Message\Routing;

enum Method: string
{
    case ALL = 'all';

    case SINGLE = 'single';
}
