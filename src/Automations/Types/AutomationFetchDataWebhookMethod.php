<?php

namespace Courier\Automations\Types;

enum AutomationFetchDataWebhookMethod: string
{
    case Get = "GET";
    case Post = "POST";
}
