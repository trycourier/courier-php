<?php

declare(strict_types=1);

namespace Courier\Broadcasts;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Update a broadcast's name. Content is edited via the broadcast's notification template, not this endpoint.
 *
 * @see Courier\Services\BroadcastsService::update()
 *
 * @phpstan-type BroadcastUpdateParamsShape = array{name: string}
 */
final class BroadcastUpdateParams implements BaseModel
{
    /** @use SdkModel<BroadcastUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * New human-readable name.
     */
    #[Required]
    public string $name;

    /**
     * `new BroadcastUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BroadcastUpdateParams::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BroadcastUpdateParams)->withName(...)
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
    public static function with(string $name): self
    {
        $self = new self;

        $self['name'] = $name;

        return $self;
    }

    /**
     * New human-readable name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
