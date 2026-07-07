<?php

declare(strict_types=1);

namespace Courier\AudienceFilterConfig;

/**
 * The logical operator (AND/OR) combining the rules in `filters`. Required when `filters` contains more than one rule. If omitted, the top-level `operator` field on the request is used instead.
 */
enum Operator: string
{
    case AND = 'AND';

    case OR = 'OR';
}
