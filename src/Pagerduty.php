<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type PagerdutyShape = array{
 *   eventAction?: string|null,
 *   routingKey?: string|null,
 *   severity?: string|null,
 *   source?: string|null,
 * }
 */
final class Pagerduty implements BaseModel
{
    /** @use SdkModel<PagerdutyShape> */
    use SdkModel;

    #[Optional('event_action', nullable: true)]
    public ?string $eventAction;

    #[Optional('routing_key', nullable: true)]
    public ?string $routingKey;

    #[Optional(nullable: true)]
    public ?string $severity;

    #[Optional(nullable: true)]
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
        $self = new self;

        null !== $eventAction && $self['eventAction'] = $eventAction;
        null !== $routingKey && $self['routingKey'] = $routingKey;
        null !== $severity && $self['severity'] = $severity;
        null !== $source && $self['source'] = $source;

        return $self;
    }

    public function withEventAction(?string $eventAction): self
    {
        $self = clone $this;
        $self['eventAction'] = $eventAction;

        return $self;
    }

    public function withRoutingKey(?string $routingKey): self
    {
        $self = clone $this;
        $self['routingKey'] = $routingKey;

        return $self;
    }

    public function withSeverity(?string $severity): self
    {
        $self = clone $this;
        $self['severity'] = $severity;

        return $self;
    }

    public function withSource(?string $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }
}
