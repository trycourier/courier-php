<?php

declare(strict_types=1);

namespace Courier\Automations\AutomationInvokeAdHocParams\Automation\Step\AutomationFetchDataStep;

enum Action: string
{
    case FETCH_DATA = 'fetch-data';
}
