<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationThrottleStep;

enum Action: string
{
    case THROTTLE = 'throttle';
}
