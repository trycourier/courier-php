<?php

declare(strict_types=1);

namespace Courier\Profiles\Lists;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Profiles\Lists\ListSubscribeResponse\Status;

/**
 * @phpstan-type ListSubscribeResponseShape = array{status: value-of<Status>}
 */
final class ListSubscribeResponse implements BaseModel
{
    /** @use SdkModel<ListSubscribeResponseShape> */
    use SdkModel;

    /** @var value-of<Status> $status */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * `new ListSubscribeResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ListSubscribeResponse::with(status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ListSubscribeResponse)->withStatus(...)
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
     *
     * @param Status|value-of<Status> $status
     */
    public static function with(Status|string $status): self
    {
        $self = new self;

        $self['status'] = $status;

        return $self;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
