<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams\Message;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\SendMessageParams\Message\Provider\Metadata;
use Courier\Utm;

/**
 * @phpstan-type ProviderShape = array{
 *   if?: string|null,
 *   metadata?: \Courier\Send\SendMessageParams\Message\Provider\Metadata|null,
 *   override?: array<string,mixed>|null,
 *   timeouts?: int|null,
 * }
 */
final class Provider implements BaseModel
{
    /** @use SdkModel<ProviderShape> */
    use SdkModel;

    /**
     * JS conditional with access to data/profile.
     */
    #[Optional(nullable: true)]
    public ?string $if;

    #[Optional(nullable: true)]
    public ?Metadata $metadata;

    /**
     * Provider-specific overrides.
     *
     * @var array<string,mixed>|null $override
     */
    #[Optional(map: 'mixed', nullable: true)]
    public ?array $override;

    #[Optional(nullable: true)]
    public ?int $timeouts;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Metadata|array{
     *   utm?: Utm|null
     * }|null $metadata
     * @param array<string,mixed>|null $override
     */
    public static function with(
        ?string $if = null,
        Metadata|array|null $metadata = null,
        ?array $override = null,
        ?int $timeouts = null,
    ): self {
        $self = new self;

        null !== $if && $self['if'] = $if;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $override && $self['override'] = $override;
        null !== $timeouts && $self['timeouts'] = $timeouts;

        return $self;
    }

    /**
     * JS conditional with access to data/profile.
     */
    public function withIf(?string $if): self
    {
        $self = clone $this;
        $self['if'] = $if;

        return $self;
    }

    /**
     * @param Metadata|array{
     *   utm?: Utm|null
     * }|null $metadata
     */
    public function withMetadata(
        Metadata|array|null $metadata,
    ): self {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Provider-specific overrides.
     *
     * @param array<string,mixed>|null $override
     */
    public function withOverride(?array $override): self
    {
        $self = clone $this;
        $self['override'] = $override;

        return $self;
    }

    public function withTimeouts(?int $timeouts): self
    {
        $self = clone $this;
        $self['timeouts'] = $timeouts;

        return $self;
    }
}
