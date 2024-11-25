<?php

namespace Courier\Automations\Types;

enum AutomationAddToBatchRetainType: string
{
    case First = "first";
    case Last = "last";
    case Highest = "highest";
    case Lowest = "lowest";
}
