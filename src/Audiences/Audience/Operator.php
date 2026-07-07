<?php

declare(strict_types=1);

namespace Courier\Audiences\Audience;

/**
 * The logical operator (AND/OR) combining the top-level `filter.filters`. Convenience alias for `filter.operator`.
 */
enum Operator: string
{
    case AND = 'AND';

    case OR = 'OR';
}
