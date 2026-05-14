<?php

declare(strict_types=1);

namespace Courier\Journeys\JourneyThrottleStaticNode;

enum Scope: string
{
    case USER = 'user';

    case GLOBAL = 'global';
}
