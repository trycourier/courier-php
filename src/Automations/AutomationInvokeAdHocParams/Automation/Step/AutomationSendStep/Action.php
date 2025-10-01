<?php

declare(strict_types=1);

namespace Courier\Automations\AutomationInvokeAdHocParams\Automation\Step\AutomationSendStep;

enum Action: string
{
    case SEND = 'send';
}
