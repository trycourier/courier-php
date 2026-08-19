<?php

declare(strict_types=1);

namespace Courier\Journeys\JourneyWebhookTriggerNode;

enum TriggerType: string
{
    case WEBHOOK = 'webhook';
}
