<?php

declare(strict_types=1);

namespace Courier\Filter;

/**
 * The operator to use for filtering.
 */
enum Operator: string
{
    case ENDS_WITH = 'ENDS_WITH';

    case EQ = 'EQ';

    case EXISTS = 'EXISTS';

    case GT = 'GT';

    case GTE = 'GTE';

    case INCLUDES = 'INCLUDES';

    case IS_AFTER = 'IS_AFTER';

    case IS_BEFORE = 'IS_BEFORE';

    case LT = 'LT';

    case LTE = 'LTE';

    case NEQ = 'NEQ';

    case OMIT = 'OMIT';

    case STARTS_WITH = 'STARTS_WITH';

    case AND = 'AND';

    case OR = 'OR';
}
