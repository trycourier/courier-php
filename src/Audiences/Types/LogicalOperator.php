<?php

namespace Courier\Audiences\Types;

enum LogicalOperator: string
{
    case And_ = "AND";
    case Or_ = "OR";
}
