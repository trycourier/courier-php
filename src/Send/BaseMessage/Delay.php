<?php

declare(strict_types=1);

namespace Courier\Send\BaseMessage;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Defines the time to wait before delivering the message. You can specify one of the following options. Duration with the number of milliseconds to delay. Until with an ISO 8601 timestamp that specifies when it should be delivered. Until with an OpenStreetMap opening_hours-like format that specifies the [Delivery Window](https://www.courier.com/docs/platform/sending/failover/#delivery-window) (e.g., 'Mo-Fr 08:00-18:00pm').
 *
 * @phpstan-type delay_alias = array{duration?: int|null, until?: string|null}
 */
final class Delay implements BaseModel
{
    /** @use SdkModel<delay_alias> */
    use SdkModel;

    /**
     * The duration of the delay in milliseconds.
     */
    #[Api(nullable: true, optional: true)]
    public ?int $duration;

    /**
     * An ISO 8601 timestamp that specifies when it should be delivered or an OpenStreetMap opening_hours-like format that specifies the [Delivery Window](https://www.courier.com/docs/platform/sending/failover/#delivery-window) (e.g., 'Mo-Fr 08:00-18:00pm').
     */
    #[Api(nullable: true, optional: true)]
    public ?string $until;

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
        ?int $duration = null,
        ?string $until = null
    ): self {
        $obj = new self;

        null !== $duration && $obj->duration = $duration;
        null !== $until && $obj->until = $until;

        return $obj;
    }

    /**
     * The duration of the delay in milliseconds.
     */
    public function withDuration(?int $duration): self
    {
        $obj = clone $this;
        $obj->duration = $duration;

        return $obj;
    }

    /**
     * An ISO 8601 timestamp that specifies when it should be delivered or an OpenStreetMap opening_hours-like format that specifies the [Delivery Window](https://www.courier.com/docs/platform/sending/failover/#delivery-window) (e.g., 'Mo-Fr 08:00-18:00pm').
     */
    public function withUntil(?string $until): self
    {
        $obj = clone $this;
        $obj->until = $until;

        return $obj;
    }
}
