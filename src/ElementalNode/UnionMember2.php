<?php

declare(strict_types=1);

namespace Courier\ElementalNode;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\ElementalNode\UnionMember2\Type;

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
 * @phpstan-type union_member2 = array{
 *   channels?: list<string>|null,
 *   if?: string|null,
 *   loop?: string|null,
 *   ref?: string|null,
 *   channel: string,
 *   raw?: array<string, mixed>|null,
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

    /**
     * The channel the contents of this element should be applied to. Can be `email`,
     * `push`, `direct_message`, `sms` or a provider such as slack.
     */
    #[Api]
    public string $channel;

    /**
     * Raw data to apply to the channel. If `elements` has not been
     * specified, `raw` is `required`.
     *
     * @var array<string, mixed>|null $raw
     */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $raw;

    /** @var value-of<Type>|null $type */
    #[Api(enum: Type::class, optional: true)]
    public ?string $type;

    /**
     * `new UnionMember2()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnionMember2::with(channel: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UnionMember2)->withChannel(...)
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
     * @param array<string, mixed>|null $raw
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $channel,
        ?array $channels = null,
        ?string $if = null,
        ?string $loop = null,
        ?string $ref = null,
        ?array $raw = null,
        Type|string|null $type = null,
    ): self {
        $obj = new self;

        $obj->channel = $channel;

        null !== $channels && $obj->channels = $channels;
        null !== $if && $obj->if = $if;
        null !== $loop && $obj->loop = $loop;
        null !== $ref && $obj->ref = $ref;
        null !== $raw && $obj->raw = $raw;
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
