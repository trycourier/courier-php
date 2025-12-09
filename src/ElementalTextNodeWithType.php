<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\ElementalTextNodeWithType\Type;

/**
 * @phpstan-type ElementalTextNodeWithTypeShape = array{
 *   channels?: list<string>|null,
 *   if?: string|null,
 *   loop?: string|null,
 *   ref?: string|null,
 *   type?: value-of<Type>|null,
 * }
 */
final class ElementalTextNodeWithType implements BaseModel
{
    /** @use SdkModel<ElementalTextNodeWithTypeShape> */
    use SdkModel;

    /** @var list<string>|null $channels */
    #[Optional(list: 'string', nullable: true)]
    public ?array $channels;

    #[Optional(nullable: true)]
    public ?string $if;

    #[Optional(nullable: true)]
    public ?string $loop;

    #[Optional(nullable: true)]
    public ?string $ref;

    /** @var value-of<Type>|null $type */
    #[Optional(enum: Type::class)]
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
        $self = new self;

        null !== $channels && $self['channels'] = $channels;
        null !== $if && $self['if'] = $if;
        null !== $loop && $self['loop'] = $loop;
        null !== $ref && $self['ref'] = $ref;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    /**
     * @param list<string>|null $channels
     */
    public function withChannels(?array $channels): self
    {
        $self = clone $this;
        $self['channels'] = $channels;

        return $self;
    }

    public function withIf(?string $if): self
    {
        $self = clone $this;
        $self['if'] = $if;

        return $self;
    }

    public function withLoop(?string $loop): self
    {
        $self = clone $this;
        $self['loop'] = $loop;

        return $self;
    }

    public function withRef(?string $ref): self
    {
        $self = clone $this;
        $self['ref'] = $ref;

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
