<?php

namespace Courier\Audiences\Types;

enum ComparisonOperator: string
{
    case EndsWith = "ENDS_WITH";
    case Eq = "EQ";
    case Exists = "EXISTS";
    case Gt = "GT";
    case Gte = "GTE";
    case Includes = "INCLUDES";
    case IsAfter = "IS_AFTER";
    case IsBefore = "IS_BEFORE";
    case Lt = "LT";
    case Lte = "LTE";
    case Neq = "NEQ";
    case Omit = "OMIT";
    case StartsWith = "STARTS_WITH";
}
