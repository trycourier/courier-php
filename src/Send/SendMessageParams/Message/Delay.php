<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams\Message;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type DelayShape = array{duration?: int|null, until?: string|null}
 */
final class Delay implements BaseModel
{
    /** @use SdkModel<DelayShape> */
    use SdkModel;

    /**
     * The duration of the delay in milliseconds.
     */
    #[Api(nullable: true, optional: true)]
    public ?int $duration;

    /**
     * ISO 8601 timestamp or opening_hours-like format.
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

        null !== $duration && $obj['duration'] = $duration;
        null !== $until && $obj['until'] = $until;

        return $obj;
    }

    /**
     * The duration of the delay in milliseconds.
     */
    public function withDuration(?int $duration): self
    {
        $obj = clone $this;
        $obj['duration'] = $duration;

        return $obj;
    }

    /**
     * ISO 8601 timestamp or opening_hours-like format.
     */
    public function withUntil(?string $until): self
    {
        $obj = clone $this;
        $obj['until'] = $until;

        return $obj;
    }
}
