<?php

declare(strict_types=1);

namespace Courier\Automations\AutomationInvokeAdHocParams\Automation\Step\AutomationSendListStep;

enum Action: string
{
    case SEND_LIST = 'send-list';
}
