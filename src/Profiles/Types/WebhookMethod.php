<?php

namespace Courier\Profiles\Types;

enum WebhookMethod: string
{
    case Post = "POST";
    case Put = "PUT";
}
