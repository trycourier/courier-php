<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\Journeys\JourneyNode\JourneyBranchNode;

/**
 * A single node in a journey DAG. Discriminated by `type`, with a secondary discriminator on some variants (`trigger_type` for trigger, `mode` for delay, `method` for fetch, `scope` for throttle).
 *
 * @phpstan-import-type JourneyAPIInvokeTriggerNodeShape from \Courier\Journeys\JourneyAPIInvokeTriggerNode
 * @phpstan-import-type JourneySegmentTriggerNodeShape from \Courier\Journeys\JourneySegmentTriggerNode
 * @phpstan-import-type JourneySendNodeShape from \Courier\Journeys\JourneySendNode
 * @phpstan-import-type JourneyDelayDurationNodeShape from \Courier\Journeys\JourneyDelayDurationNode
 * @phpstan-import-type JourneyDelayUntilNodeShape from \Courier\Journeys\JourneyDelayUntilNode
 * @phpstan-import-type JourneyFetchGetDeleteNodeShape from \Courier\Journeys\JourneyFetchGetDeleteNode
 * @phpstan-import-type JourneyFetchPostPutNodeShape from \Courier\Journeys\JourneyFetchPostPutNode
 * @phpstan-import-type JourneyAINodeShape from \Courier\Journeys\JourneyAINode
 * @phpstan-import-type JourneyThrottleStaticNodeShape from \Courier\Journeys\JourneyThrottleStaticNode
 * @phpstan-import-type JourneyThrottleDynamicNodeShape from \Courier\Journeys\JourneyThrottleDynamicNode
 * @phpstan-import-type JourneyExitNodeShape from \Courier\Journeys\JourneyExitNode
 * @phpstan-import-type JourneyBranchNodeShape from \Courier\Journeys\JourneyNode\JourneyBranchNode
 *
 * @phpstan-type JourneyNodeVariants = JourneyAPIInvokeTriggerNode|JourneySegmentTriggerNode|JourneySendNode|JourneyDelayDurationNode|JourneyDelayUntilNode|JourneyFetchGetDeleteNode|JourneyFetchPostPutNode|JourneyAINode|JourneyThrottleStaticNode|JourneyThrottleDynamicNode|JourneyExitNode|JourneyBranchNode
 * @phpstan-type JourneyNodeShape = JourneyNodeVariants|JourneyAPIInvokeTriggerNodeShape|JourneySegmentTriggerNodeShape|JourneySendNodeShape|JourneyDelayDurationNodeShape|JourneyDelayUntilNodeShape|JourneyFetchGetDeleteNodeShape|JourneyFetchPostPutNodeShape|JourneyAINodeShape|JourneyThrottleStaticNodeShape|JourneyThrottleDynamicNodeShape|JourneyExitNodeShape|JourneyBranchNodeShape
 */
final class JourneyNode implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            JourneyAPIInvokeTriggerNode::class,
            JourneySegmentTriggerNode::class,
            JourneySendNode::class,
            JourneyDelayDurationNode::class,
            JourneyDelayUntilNode::class,
            JourneyFetchGetDeleteNode::class,
            JourneyFetchPostPutNode::class,
            JourneyAINode::class,
            JourneyThrottleStaticNode::class,
            JourneyThrottleDynamicNode::class,
            JourneyExitNode::class,
            JourneyBranchNode::class,
        ];
    }
}
