<?php

declare(strict_types=1);

namespace Courier\Send\ElementalNode;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\ElementalNode\Type\Type as Type1;

/**
 * @phpstan-type type_alias = array{type: value-of<Type1>}
 */
final class Type implements BaseModel
{
    /** @use SdkModel<type_alias> */
    use SdkModel;

    /** @var value-of<Type1> $type */
    #[Api(enum: Type1::class)]
    public string $type;

    /**
     * `new Type()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Type::with(type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Type)->withType(...)
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
     * @param Type1|value-of<Type1> $type
     */
    public static function with(Type1|string $type): self
    {
        $obj = new self;

        $obj->type = $type instanceof Type1 ? $type->value : $type;

        return $obj;
    }

    /**
     * @param Type1|value-of<Type1> $type
     */
    public function withType(Type1|string $type): self
    {
        $obj = clone $this;
        $obj->type = $type instanceof Type1 ? $type->value : $type;

        return $obj;
    }
}
