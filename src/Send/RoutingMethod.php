<?php

declare(strict_types=1);

namespace Courier\Send;

enum RoutingMethod: string
{
    case ALL = 'all';

    case SINGLE = 'single';
}
