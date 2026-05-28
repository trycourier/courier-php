<?php

declare(strict_types=1);

namespace Courier\Journeys\JourneyNode\JourneyBatchNode\Retain;

enum Type: string
{
    case FIRST = 'first';

    case LAST = 'last';

    case HIGHEST = 'highest';

    case LOWEST = 'lowest';
}
