<?php

declare(strict_types=1);

namespace Courier\Notifications\Checks;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\Checks\BaseCheck\Status;
use Courier\Notifications\Checks\BaseCheck\Type;

/**
 * @phpstan-type check_alias = array{
 *   id: string, status: value-of<Status>, type: value-of<Type>, updated: int
 * }
 */
final class Check implements BaseModel
{
    /** @use SdkModel<check_alias> */
    use SdkModel;

    #[Api]
    public string $id;

    /** @var value-of<Status> $status */
    #[Api(enum: Status::class)]
    public string $status;

    /** @var value-of<Type> $type */
    #[Api(enum: Type::class)]
    public string $type;

    #[Api]
    public int $updated;

    /**
     * `new Check()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Check::with(id: ..., status: ..., type: ..., updated: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Check)->withID(...)->withStatus(...)->withType(...)->withUpdated(...)
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
        Type|string $type,
        int $updated
    ): self {
        $obj = new self;

        $obj->id = $id;
        $obj->status = $status instanceof Status ? $status->value : $status;
        $obj->type = $type instanceof Type ? $type->value : $type;
        $obj->updated = $updated;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $obj = clone $this;
        $obj->status = $status instanceof Status ? $status->value : $status;

        return $obj;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $obj = clone $this;
        $obj->type = $type instanceof Type ? $type->value : $type;

        return $obj;
    }

    public function withUpdated(int $updated): self
    {
        $obj = clone $this;
        $obj->updated = $updated;

        return $obj;
    }
}
