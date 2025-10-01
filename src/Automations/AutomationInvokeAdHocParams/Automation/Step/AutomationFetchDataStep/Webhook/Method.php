<?php

declare(strict_types=1);

namespace Courier\Automations\AutomationInvokeAdHocParams\Automation\Step\AutomationFetchDataStep\Webhook;

enum Method: string
{
    case GET = 'GET';

    case POST = 'POST';
}
