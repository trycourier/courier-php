<?php

declare(strict_types=1);

namespace Courier\Tenants\Templates\ElementalContent\Element;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Tenants\Templates\ElementalContent\Element\UnionMember2\Type;

/**
 * @phpstan-type union_member2 = array{
 *   channels?: list<string>|null,
 *   if?: string|null,
 *   loop?: string|null,
 *   ref?: string|null,
 *   type?: value-of<Type>,
 * }
 */
final class UnionMember2 implements BaseModel
{
    /** @use SdkModel<union_member2> */
    use SdkModel;

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

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $channels
     * @param Type|value-of<Type> $type
     */
    public static function with(
        ?array $channels = null,
        ?string $if = null,
        ?string $loop = null,
        ?string $ref = null,
        Type|string|null $type = null,
    ): self {
        $obj = new self;

        null !== $channels && $obj->channels = $channels;
        null !== $if && $obj->if = $if;
        null !== $loop && $obj->loop = $loop;
        null !== $ref && $obj->ref = $ref;
        null !== $type && $obj['type'] = $type;

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
        $obj['type'] = $type;

        return $obj;
    }
}
