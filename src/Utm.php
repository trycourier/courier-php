<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type UtmShape = array{
 *   campaign?: string|null,
 *   content?: string|null,
 *   medium?: string|null,
 *   source?: string|null,
 *   term?: string|null,
 * }
 */
final class Utm implements BaseModel
{
    /** @use SdkModel<UtmShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?string $campaign;

    #[Optional(nullable: true)]
    public ?string $content;

    #[Optional(nullable: true)]
    public ?string $medium;

    #[Optional(nullable: true)]
    public ?string $source;

    #[Optional(nullable: true)]
    public ?string $term;

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
        ?string $campaign = null,
        ?string $content = null,
        ?string $medium = null,
        ?string $source = null,
        ?string $term = null,
    ): self {
        $self = new self;

        null !== $campaign && $self['campaign'] = $campaign;
        null !== $content && $self['content'] = $content;
        null !== $medium && $self['medium'] = $medium;
        null !== $source && $self['source'] = $source;
        null !== $term && $self['term'] = $term;

        return $self;
    }

    public function withCampaign(?string $campaign): self
    {
        $self = clone $this;
        $self['campaign'] = $campaign;

        return $self;
    }

    public function withContent(?string $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }

    public function withMedium(?string $medium): self
    {
        $self = clone $this;
        $self['medium'] = $medium;

        return $self;
    }

    public function withSource(?string $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }

    public function withTerm(?string $term): self
    {
        $self = clone $this;
        $self['term'] = $term;

        return $self;
    }
}
