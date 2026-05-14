<?php

declare(strict_types=1);

namespace Courier\Journeys\JourneySendNode\Message;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type DelayShape = array{until: string, timezone?: string|null}
 */
final class Delay implements BaseModel
{
    /** @use SdkModel<DelayShape> */
    use SdkModel;

    #[Required]
    public string $until;

    #[Optional]
    public ?string $timezone;

    /**
     * `new Delay()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Delay::with(until: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Delay)->withUntil(...)
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
    public static function with(string $until, ?string $timezone = null): self
    {
        $self = new self;

        $self['until'] = $until;

        null !== $timezone && $self['timezone'] = $timezone;

        return $self;
    }

    public function withUntil(string $until): self
    {
        $self = clone $this;
        $self['until'] = $until;

        return $self;
    }

    public function withTimezone(string $timezone): self
    {
        $self = clone $this;
        $self['timezone'] = $timezone;

        return $self;
    }
}
