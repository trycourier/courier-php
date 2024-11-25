<?php

namespace Courier\Send\Types;

enum Criteria: string
{
    case NoEscalation = "no-escalation";
    case Delivered = "delivered";
    case Viewed = "viewed";
    case Engaged = "engaged";
}
