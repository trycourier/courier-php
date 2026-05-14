<?php

declare(strict_types=1);

namespace Courier\Journeys\JourneySegmentTriggerNode;

enum RequestType: string
{
    case IDENTIFY = 'identify';

    case GROUP = 'group';

    case TRACK = 'track';
}
