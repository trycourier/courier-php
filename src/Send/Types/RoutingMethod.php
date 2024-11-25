<?php

namespace Courier\Send\Types;

enum RoutingMethod: string
{
    case All = "all";
    case Single = "single";
}
