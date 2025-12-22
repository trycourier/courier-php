<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\BaseCheck\Status;
use Courier\Notifications\BaseCheck\Type;

/**
 * @phpstan-type BaseCheckShape = array{
 *   id: string, status: Status|value-of<Status>, type: Type|value-of<Type>
 * }
 */
final class BaseCheck implements BaseModel
{
    /** @use SdkModel<BaseCheckShape> */
    use SdkModel;

    #[Required]
    public string $id;

    /** @var value-of<Status> $status */
    #[Required(enum: Status::class)]
    public string $status;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new BaseCheck()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BaseCheck::with(id: ..., status: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BaseCheck)->withID(...)->withStatus(...)->withType(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        Status|string $status,
        Type|string $type
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['status'] = $status;
        $self['type'] = $type;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

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

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
