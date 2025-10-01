<?php

declare(strict_types=1);

namespace Courier\Send\BaseMessage\Channel;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type timeouts_alias = array{channel?: int|null, provider?: int|null}
 */
final class Timeouts implements BaseModel
{
    /** @use SdkModel<timeouts_alias> */
    use SdkModel;

    #[Api(nullable: true, optional: true)]
    public ?int $channel;

    #[Api(nullable: true, optional: true)]
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
        $obj = new self;

        null !== $channel && $obj->channel = $channel;
        null !== $provider && $obj->provider = $provider;

        return $obj;
    }

    public function withChannel(?int $channel): self
    {
        $obj = clone $this;
        $obj->channel = $channel;

        return $obj;
    }

    public function withProvider(?int $provider): self
    {
        $obj = clone $this;
        $obj->provider = $provider;

        return $obj;
    }
}
