<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type RuleShape = array{until: string, start?: string|null}
 */
final class Rule implements BaseModel
{
    /** @use SdkModel<RuleShape> */
    use SdkModel;

    #[Required]
    public string $until;

    #[Optional(nullable: true)]
    public ?string $start;

    /**
     * `new Rule()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Rule::with(until: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Rule)->withUntil(...)
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
    public static function with(string $until, ?string $start = null): self
    {
        $self = new self;

        $self['until'] = $until;

        null !== $start && $self['start'] = $start;

        return $self;
    }

    public function withUntil(string $until): self
    {
        $self = clone $this;
        $self['until'] = $until;

        return $self;
    }

    public function withStart(?string $start): self
    {
        $self = clone $this;
        $self['start'] = $start;

        return $self;
    }
}
