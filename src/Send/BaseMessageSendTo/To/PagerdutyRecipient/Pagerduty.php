<?php

declare(strict_types=1);

namespace Courier\Send\BaseMessageSendTo\To\PagerdutyRecipient;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type pagerduty_alias = array{
 *   eventAction?: string|null,
 *   routingKey?: string|null,
 *   severity?: string|null,
 *   source?: string|null,
 * }
 */
final class Pagerduty implements BaseModel
{
    /** @use SdkModel<pagerduty_alias> */
    use SdkModel;

    #[Api('event_action', nullable: true, optional: true)]
    public ?string $eventAction;

    #[Api('routing_key', nullable: true, optional: true)]
    public ?string $routingKey;

    #[Api(nullable: true, optional: true)]
    public ?string $severity;

    #[Api(nullable: true, optional: true)]
    public ?string $source;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $eventAction = null,
        ?string $routingKey = null,
        ?string $severity = null,
        ?string $source = null,
    ): self {
        $obj = new self;

        null !== $eventAction && $obj->eventAction = $eventAction;
        null !== $routingKey && $obj->routingKey = $routingKey;
        null !== $severity && $obj->severity = $severity;
        null !== $source && $obj->source = $source;

        return $obj;
    }

    public function withEventAction(?string $eventAction): self
    {
        $obj = clone $this;
        $obj->eventAction = $eventAction;

        return $obj;
    }

    public function withRoutingKey(?string $routingKey): self
    {
        $obj = clone $this;
        $obj->routingKey = $routingKey;

        return $obj;
    }

    public function withSeverity(?string $severity): self
    {
        $obj = clone $this;
        $obj->severity = $severity;

        return $obj;
    }

    public function withSource(?string $source): self
    {
        $obj = clone $this;
        $obj->source = $source;

        return $obj;
    }
}
