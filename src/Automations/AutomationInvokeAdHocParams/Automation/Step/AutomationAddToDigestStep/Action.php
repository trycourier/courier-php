<?php

declare(strict_types=1);

namespace Courier\Automations\AutomationInvokeAdHocParams\Automation\Step\AutomationAddToDigestStep;

enum Action: string
{
    case ADD_TO_DIGEST = 'add-to-digest';
}
