<?php

declare(strict_types=1);

namespace Courier\Audiences\AudienceUpdateParams;

/**
 * The logical operator (AND/OR) combining the top-level `filter.filters`. Convenience alias for `filter.operator`: if set, it is applied to the top-level filter group. Prefer setting `operator` directly inside `filter`.
 */
enum Operator: string
{
    case AND = 'AND';

    case OR = 'OR';
}
