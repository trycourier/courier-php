<?php

declare(strict_types=1);

namespace Courier\Send;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\ElementalNode\UnionMember0;
use Courier\Send\ElementalNode\UnionMember1;
use Courier\Send\ElementalNode\UnionMember2;
use Courier\Send\ElementalNode\UnionMember3;
use Courier\Send\ElementalNode\UnionMember4;
use Courier\Send\ElementalNode\UnionMember5;
use Courier\Send\ElementalNode\UnionMember6;
use Courier\Send\ElementalNode\UnionMember7;

/**
 * @phpstan-type elemental_group_node = array{
 *   elements: list<UnionMember0|UnionMember1|union_member2|UnionMember3|UnionMember4|UnionMember5|union_member6|UnionMember7>,
 *   channels?: list<string>|null,
 *   if?: string|null,
 *   loop?: string|null,
 *   ref?: string|null,
 * }
 */
final class ElementalGroupNode implements BaseModel
{
    /** @use SdkModel<elemental_group_node> */
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

    /**
     * `new ElementalGroupNode()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ElementalGroupNode::with(elements: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ElementalGroupNode)->withElements(...)
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
     */
    public static function with(
        array $elements,
        ?array $channels = null,
        ?string $if = null,
        ?string $loop = null,
        ?string $ref = null,
    ): self {
        $obj = new self;

        $obj->elements = $elements;

        null !== $channels && $obj->channels = $channels;
        null !== $if && $obj->if = $if;
        null !== $loop && $obj->loop = $loop;
        null !== $ref && $obj->ref = $ref;

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
}
