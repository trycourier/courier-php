<?php

declare(strict_types=1);

namespace Courier\Automations\AutomationInvokeAdHocParams\Automation\Step\AutomationThrottleStep;

enum Scope: string
{
    case USER = 'user';

    case GLOBAL = 'global';

    case DYNAMIC = 'dynamic';
}
