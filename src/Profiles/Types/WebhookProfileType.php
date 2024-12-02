<?php

namespace Courier\Profiles\Types;

enum WebhookProfileType: string
{
    case Limited = "limited";
    case Expanded = "expanded";
}
