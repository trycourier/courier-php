<?php

declare(strict_types=1);

namespace Courier\Audiences\AudienceUpdateParams;

/**
 * The logical operator (AND/OR) for the top-level filter.
 */
enum Operator: string
{
    case AND = 'AND';

    case OR = 'OR';
}
