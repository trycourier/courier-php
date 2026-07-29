<?php

declare(strict_types=1);

namespace Courier\Broadcasts;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Request body for updating a broadcast. Only the name is mutable.
 *
 * @phpstan-type UpdateBroadcastRequestShape = array{name: string}
 */
final class UpdateBroadcastRequest implements BaseModel
{
    /** @use SdkModel<UpdateBroadcastRequestShape> */
    use SdkModel;

    /**
     * New human-readable name.
     */
    #[Required]
    public string $name;

    /**
     * `new UpdateBroadcastRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UpdateBroadcastRequest::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UpdateBroadcastRequest)->withName(...)
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
