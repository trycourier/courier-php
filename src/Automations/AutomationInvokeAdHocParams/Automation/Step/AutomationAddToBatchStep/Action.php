<?php

declare(strict_types=1);

namespace Courier\Automations\AutomationInvokeAdHocParams\Automation\Step\AutomationAddToBatchStep;

enum Action: string
{
    case ADD_TO_BATCH = 'add-to-batch';
}
