<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\ElementalChannelNodeWithType\Type;

/**
 * The channel element allows a notification to be customized based on which channel it is sent through.
 * For example, you may want to display a detailed message when the notification is sent through email,
 * and a more concise message in a push notification. Channel elements are only valid as top-level
 * elements; you cannot nest channel elements. If there is a channel element specified at the top-level
 * of the document, all sibling elements must be channel elements.
 * Note: As an alternative, most elements support a `channel` property. Which allows you to selectively
 * display an individual element on a per channel basis. See the
 * [control flow docs](https://www.courier.com/docs/platform/content/elemental/control-flow/) for more details.
 *
 * @phpstan-type ElementalChannelNodeWithTypeShape = array{
 *   channels?: list<string>|null,
 *   if?: string|null,
 *   loop?: string|null,
 *   ref?: string|null,
 *   channel?: string|null,
 *   raw?: array<string,mixed>|null,
 *   type?: null|Type|value-of<Type>,
 * }
 */
final class ElementalChannelNodeWithType implements BaseModel
{
    /** @use SdkModel<ElementalChannelNodeWithTypeShape> */
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

    /**
     * The channel the contents of this element should be applied to. Can be `email`,
     * `push`, `direct_message`, `sms` or a provider such as slack.
     */
    #[Optional]
    public ?string $channel;

    /**
     * Raw data to apply to the channel. If `elements` has not been specified, `raw` is required.
     *
     * @var array<string,mixed>|null $raw
     */
    #[Optional(map: 'mixed', nullable: true)]
    public ?array $raw;

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
     * @param array<string,mixed>|null $raw
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        ?array $channels = null,
        ?string $if = null,
        ?string $loop = null,
        ?string $ref = null,
        ?string $channel = null,
        ?array $raw = null,
        Type|string|null $type = null,
    ): self {
        $self = new self;

        null !== $channels && $self['channels'] = $channels;
        null !== $if && $self['if'] = $if;
        null !== $loop && $self['loop'] = $loop;
        null !== $ref && $self['ref'] = $ref;
        null !== $channel && $self['channel'] = $channel;
        null !== $raw && $self['raw'] = $raw;
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
     * The channel the contents of this element should be applied to. Can be `email`,
     * `push`, `direct_message`, `sms` or a provider such as slack.
     */
    public function withChannel(string $channel): self
    {
        $self = clone $this;
        $self['channel'] = $channel;

        return $self;
    }

    /**
     * Raw data to apply to the channel. If `elements` has not been specified, `raw` is required.
     *
     * @param array<string,mixed>|null $raw
     */
    public function withRaw(?array $raw): self
    {
        $self = clone $this;
        $self['raw'] = $raw;

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
