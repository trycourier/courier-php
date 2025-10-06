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

/**
 * @phpstan-type elemental_channel_node = array{
 *   channel: string,
 *   channels?: list<string>|null,
 *   elements?: list<UnionMember0|UnionMember1|UnionMember2|UnionMember3|UnionMember4|UnionMember5|UnionMember6>|null,
 *   if?: string|null,
 *   loop?: string|null,
 *   raw?: array<string, mixed>|null,
 *   ref?: string|null,
 * }
 */
final class ElementalChannelNode implements BaseModel
{
    /** @use SdkModel<elemental_channel_node> */
    use SdkModel;

    /**
     * The channel the contents of this element should be applied to. Can be `email`,
     * `push`, `direct_message`, `sms` or a provider such as slack.
     */
    #[Api]
    public string $channel;

    /** @var list<string>|null $channels */
    #[Api(list: 'string', nullable: true, optional: true)]
    public ?array $channels;

    /**
     * An array of elements to apply to the channel. If `raw` has not been
     * specified, `elements` is `required`.
     *
     * @var list<UnionMember0|UnionMember1|UnionMember2|UnionMember3|UnionMember4|UnionMember5|UnionMember6>|null $elements
     */
    #[Api(list: ElementalNode::class, nullable: true, optional: true)]
    public ?array $elements;

    #[Api(nullable: true, optional: true)]
    public ?string $if;

    #[Api(nullable: true, optional: true)]
    public ?string $loop;

    /**
     * Raw data to apply to the channel. If `elements` has not been
     * specified, `raw` is `required`.
     *
     * @var array<string, mixed>|null $raw
     */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $raw;

    #[Api(nullable: true, optional: true)]
    public ?string $ref;

    /**
     * `new ElementalChannelNode()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ElementalChannelNode::with(channel: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ElementalChannelNode)->withChannel(...)
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
     * @param list<string>|null $channels
     * @param list<UnionMember0|UnionMember1|UnionMember2|UnionMember3|UnionMember4|UnionMember5|UnionMember6>|null $elements
     * @param array<string, mixed>|null $raw
     */
    public static function with(
        string $channel,
        ?array $channels = null,
        ?array $elements = null,
        ?string $if = null,
        ?string $loop = null,
        ?array $raw = null,
        ?string $ref = null,
    ): self {
        $obj = new self;

        $obj->channel = $channel;

        null !== $channels && $obj->channels = $channels;
        null !== $elements && $obj->elements = $elements;
        null !== $if && $obj->if = $if;
        null !== $loop && $obj->loop = $loop;
        null !== $raw && $obj->raw = $raw;
        null !== $ref && $obj->ref = $ref;

        return $obj;
    }

    /**
     * The channel the contents of this element should be applied to. Can be `email`,
     * `push`, `direct_message`, `sms` or a provider such as slack.
     */
    public function withChannel(string $channel): self
    {
        $obj = clone $this;
        $obj->channel = $channel;

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

    /**
     * An array of elements to apply to the channel. If `raw` has not been
     * specified, `elements` is `required`.
     *
     * @param list<UnionMember0|UnionMember1|UnionMember2|UnionMember3|UnionMember4|UnionMember5|UnionMember6>|null $elements
     */
    public function withElements(?array $elements): self
    {
        $obj = clone $this;
        $obj->elements = $elements;

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

    /**
     * Raw data to apply to the channel. If `elements` has not been
     * specified, `raw` is `required`.
     *
     * @param array<string, mixed>|null $raw
     */
    public function withRaw(?array $raw): self
    {
        $obj = clone $this;
        $obj->raw = $raw;

        return $obj;
    }

    public function withRef(?string $ref): self
    {
        $obj = clone $this;
        $obj->ref = $ref;

        return $obj;
    }
}
