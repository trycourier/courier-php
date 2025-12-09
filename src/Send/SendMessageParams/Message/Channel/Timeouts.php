<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams\Message\Channel;

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
        $obj = new self;

        null !== $channel && $obj['channel'] = $channel;
        null !== $provider && $obj['provider'] = $provider;

        return $obj;
    }

    public function withChannel(?int $channel): self
    {
        $obj = clone $this;
        $obj['channel'] = $channel;

        return $obj;
    }

    public function withProvider(?int $provider): self
    {
        $obj = clone $this;
        $obj['provider'] = $provider;

        return $obj;
    }
}
