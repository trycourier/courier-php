<?php

declare(strict_types=1);

namespace Courier\Tenants\TenantTemplateInput\Channel;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type TimeoutsShape = array{channel?: int|null, provider?: int|null}
 */
final class Timeouts implements BaseModel
{
    /** @use SdkModel<TimeoutsShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?int $channel;

    #[Optional(nullable: true)]
    public ?int $provider;

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
        ?int $channel = null,
        ?int $provider = null
    ): self {
        $self = new self;

        null !== $channel && $self['channel'] = $channel;
        null !== $provider && $self['provider'] = $provider;

        return $self;
    }

    public function withChannel(?int $channel): self
    {
        $self = clone $this;
        $self['channel'] = $channel;

        return $self;
    }

    public function withProvider(?int $provider): self
    {
        $self = clone $this;
        $self['provider'] = $provider;

        return $self;
    }
}
