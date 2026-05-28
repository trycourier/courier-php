<?php

declare(strict_types=1);

namespace Courier\Journeys\JourneyAPIInvokeTriggerNode;

enum TriggerType: string
{
    case API_INVOKE = 'api-invoke';
}
