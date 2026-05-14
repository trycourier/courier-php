<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\Core\Conversion\ListOf;

/**
 * Condition spec for a journey node. Accepts a single condition atom, an AND/OR group, or an AND/OR nested group. Omit the `conditions` property entirely to express "no conditions".
 *
 * @phpstan-import-type JourneyConditionGroupShape from \Courier\Journeys\JourneyConditionGroup
 * @phpstan-import-type JourneyConditionNestedGroupShape from \Courier\Journeys\JourneyConditionNestedGroup
 *
 * @phpstan-type JourneyConditionsFieldVariants = list<string>|JourneyConditionGroup|JourneyConditionNestedGroup
 * @phpstan-type JourneyConditionsFieldShape = JourneyConditionsFieldVariants|JourneyConditionGroupShape|JourneyConditionNestedGroupShape
 */
final class JourneyConditionsField implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            new ListOf('string'),
            JourneyConditionGroup::class,
            JourneyConditionNestedGroup::class,
        ];
    }
}
