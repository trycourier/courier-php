<?php

declare(strict_types=1);

namespace Courier\Send\ElementalNode;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\ElementalNode;
use Courier\Send\ElementalNode\UnionMember6\Type;

/**
 * Allows you to group elements together. This can be useful when used in combination with "if" or "loop". See [control flow docs](https://www.courier.com/docs/platform/content/elemental/control-flow/) for more details.
 *
 * @phpstan-type union_member6 = array{
 *   elements: list<UnionMember0|UnionMember1|union_member2|UnionMember3|UnionMember4|UnionMember5|union_member6|UnionMember7>,
 *   channels?: list<string>|null,
 *   if?: string|null,
 *   loop?: string|null,
 *   ref?: string|null,
 *   type?: value-of<Type>,
 * }
 */
final class UnionMember6 implements BaseModel
{
    /** @use SdkModel<union_member6> */
    use SdkModel;

    /**
     * Sub elements to render.
     *
     * @var list<UnionMember0|UnionMember1|UnionMember2|UnionMember3|UnionMember4|UnionMember5|UnionMember6|UnionMember7> $elements
     */
    #[Api(list: ElementalNode::class)]
    public array $elements;

    /** @var list<string>|null $channels */
    #[Api(list: 'string', nullable: true, optional: true)]
    public ?array $channels;

    #[Api(nullable: true, optional: true)]
    public ?string $if;

    #[Api(nullable: true, optional: true)]
    public ?string $loop;

    #[Api(nullable: true, optional: true)]
    public ?string $ref;

    /** @var value-of<Type>|null $type */
    #[Api(enum: Type::class, optional: true)]
    public ?string $type;

    /**
     * `new UnionMember6()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnionMember6::with(elements: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UnionMember6)->withElements(...)
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
     * @param list<UnionMember0|UnionMember1|UnionMember2|UnionMember3|UnionMember4|UnionMember5|UnionMember6|UnionMember7> $elements
     * @param list<string>|null $channels
     * @param Type|value-of<Type> $type
     */
    public static function with(
        array $elements,
        ?array $channels = null,
        ?string $if = null,
        ?string $loop = null,
        ?string $ref = null,
        Type|string|null $type = null,
    ): self {
        $obj = new self;

        $obj->elements = $elements;

        null !== $channels && $obj->channels = $channels;
        null !== $if && $obj->if = $if;
        null !== $loop && $obj->loop = $loop;
        null !== $ref && $obj->ref = $ref;
        null !== $type && $obj->type = $type instanceof Type ? $type->value : $type;

        return $obj;
    }

    /**
     * Sub elements to render.
     *
     * @param list<UnionMember0|UnionMember1|UnionMember2|UnionMember3|UnionMember4|UnionMember5|UnionMember6|UnionMember7> $elements
     */
    public function withElements(array $elements): self
    {
        $obj = clone $this;
        $obj->elements = $elements;

        return $obj;
    }

    /**
     * @param list<string>|null $channels
     */
    public function withChannels(?array $channels): self
    {
        $obj = clone $this;
        $obj->channels = $channels;

        return $obj;
    }

    public function withIf(?string $if): self
    {
        $obj = clone $this;
        $obj->if = $if;

        return $obj;
    }

    public function withLoop(?string $loop): self
    {
        $obj = clone $this;
        $obj->loop = $loop;

        return $obj;
    }

    public function withRef(?string $ref): self
    {
        $obj = clone $this;
        $obj->ref = $ref;

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
}
