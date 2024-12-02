<?php

namespace Courier\Automations\Types;

enum AutomationAddToBatchScope: string
{
    case User = "user";
    case Global_ = "global";
    case Dynamic = "dynamic";
}
