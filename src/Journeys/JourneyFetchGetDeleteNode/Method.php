<?php

declare(strict_types=1);

namespace Courier\Journeys\JourneyFetchGetDeleteNode;

enum Method: string
{
    case GET = 'get';

    case DELETE = 'delete';
}
