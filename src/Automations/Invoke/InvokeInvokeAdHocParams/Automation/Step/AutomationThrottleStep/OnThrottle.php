<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationThrottleStep;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type on_throttle = array{nodeID: string}
 */
final class OnThrottle implements BaseModel
{
    /** @use SdkModel<on_throttle> */
    use SdkModel;

    /**
     * The node to go to if the request is throttled.
     */
    #[Api('$node_id')]
    public string $nodeID;

    /**
     * `new OnThrottle()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OnThrottle::with(nodeID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OnThrottle)->withNodeID(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $nodeID): self
    {
        $obj = new self;

        $obj->nodeID = $nodeID;

        return $obj;
    }

    /**
     * The node to go to if the request is throttled.
     */
    public function withNodeID(string $nodeID): self
    {
        $obj = clone $this;
        $obj->nodeID = $nodeID;

        return $obj;
    }
}
