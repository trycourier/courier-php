<?php

namespace Courier\Notifications\Types;

enum MessageRoutingMethod: string
{
    case All = "all";
    case Single = "single";
}
