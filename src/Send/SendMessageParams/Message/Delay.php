<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams\Message;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type DelayShape = array{
 *   duration?: int|null, timezone?: string|null, until?: string|null
 * }
 */
final class Delay implements BaseModel
{
    /** @use SdkModel<DelayShape> */
    use SdkModel;

    /**
     * The duration of the delay in milliseconds.
     */
    #[Optional(nullable: true)]
    public ?int $duration;

    /**
     * IANA timezone identifier (e.g., "America/Los_Angeles", "UTC"). Used when resolving opening hours expressions. Takes precedence over user profile timezone settings.
     */
    #[Optional(nullable: true)]
    public ?string $timezone;

    /**
     * ISO 8601 timestamp or opening_hours-like format.
     */
    #[Optional(nullable: true)]
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
        ?string $timezone = null,
        ?string $until = null
    ): self {
        $self = new self;

        null !== $duration && $self['duration'] = $duration;
        null !== $timezone && $self['timezone'] = $timezone;
        null !== $until && $self['until'] = $until;

        return $self;
    }

    /**
     * The duration of the delay in milliseconds.
     */
    public function withDuration(?int $duration): self
    {
        $self = clone $this;
        $self['duration'] = $duration;

        return $self;
    }

    /**
     * IANA timezone identifier (e.g., "America/Los_Angeles", "UTC"). Used when resolving opening hours expressions. Takes precedence over user profile timezone settings.
     */
    public function withTimezone(?string $timezone): self
    {
        $self = clone $this;
        $self['timezone'] = $timezone;

        return $self;
    }

    /**
     * ISO 8601 timestamp or opening_hours-like format.
     */
    public function withUntil(?string $until): self
    {
        $self = clone $this;
        $self['until'] = $until;

        return $self;
    }
}
