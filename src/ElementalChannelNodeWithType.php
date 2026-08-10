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
 *   fontSize?: string|null,
 *   lineHeight?: string|null,
 *   padding?: string|null,
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
     * Email only. Document-level base font size (CSS px, e.g. `16px`) for body content — text, quote, list and action button labels. Heading styles (`h1`/`h2`/`h3`) and `subtext` keep their preset sizes.
     */
    #[Optional('font_size', nullable: true)]
    public ?string $fontSize;

    /**
     * Email only. Document-level line height (CSS px or unitless multiplier, e.g. `24px` or `1.5`) applied to all body content unless overridden per block.
     */
    #[Optional('line_height', nullable: true)]
    public ?string $lineHeight;

    /**
     * Email only. Document-level body padding applied once around the email body, as a CSS px shorthand (1–4 values), e.g. `48px 64px`.
     */
    #[Optional(nullable: true)]
    public ?string $padding;

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
        ?string $fontSize = null,
        ?string $lineHeight = null,
        ?string $padding = null,
        ?array $raw = null,
        Type|string|null $type = null,
    ): self {
        $self = new self;

        null !== $channels && $self['channels'] = $channels;
        null !== $if && $self['if'] = $if;
        null !== $loop && $self['loop'] = $loop;
        null !== $ref && $self['ref'] = $ref;
        null !== $channel && $self['channel'] = $channel;
        null !== $fontSize && $self['fontSize'] = $fontSize;
        null !== $lineHeight && $self['lineHeight'] = $lineHeight;
        null !== $padding && $self['padding'] = $padding;
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
     * Email only. Document-level base font size (CSS px, e.g. `16px`) for body content — text, quote, list and action button labels. Heading styles (`h1`/`h2`/`h3`) and `subtext` keep their preset sizes.
     */
    public function withFontSize(?string $fontSize): self
    {
        $self = clone $this;
        $self['fontSize'] = $fontSize;

        return $self;
    }

    /**
     * Email only. Document-level line height (CSS px or unitless multiplier, e.g. `24px` or `1.5`) applied to all body content unless overridden per block.
     */
    public function withLineHeight(?string $lineHeight): self
    {
        $self = clone $this;
        $self['lineHeight'] = $lineHeight;

        return $self;
    }

    /**
     * Email only. Document-level body padding applied once around the email body, as a CSS px shorthand (1–4 values), e.g. `48px 64px`.
     */
    public function withPadding(?string $padding): self
    {
        $self = clone $this;
        $self['padding'] = $padding;

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
