<?php

namespace Courier\Automations\Types;

enum AutomationThrottleScope: string
{
    case User = "user";
    case Global_ = "global";
    case Dynamic = "dynamic";
}
