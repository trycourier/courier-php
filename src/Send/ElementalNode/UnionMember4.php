<?php

declare(strict_types=1);

namespace Courier\Send\ElementalNode;

use Courier\Alignment;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\ElementalNode\UnionMember4\Locale;
use Courier\Send\ElementalNode\UnionMember4\Style;
use Courier\Send\ElementalNode\UnionMember4\Type;

/**
 * @phpstan-type union_member4 = array{
 *   actionID?: string|null,
 *   align?: value-of<Alignment>|null,
 *   backgroundColor?: string|null,
 *   content?: string,
 *   href?: string,
 *   locales?: array<string, Locale>|null,
 *   style?: value-of<Style>|null,
 *   type?: value-of<Type>,
 * }
 */
final class UnionMember4 implements BaseModel
{
    /** @use SdkModel<union_member4> */
    use SdkModel;

    /**
     * A unique id used to identify the action when it is executed.
     */
    #[Api('action_id', nullable: true, optional: true)]
    public ?string $actionID;

    /**
     * The alignment of the action button. Defaults to "center".
     *
     * @var value-of<Alignment>|null $align
     */
    #[Api(enum: Alignment::class, nullable: true, optional: true)]
    public ?string $align;

    /**
     * The background color of the action button.
     */
    #[Api('background_color', nullable: true, optional: true)]
    public ?string $backgroundColor;

    /**
     * The text content of the action shown to the user.
     */
    #[Api(optional: true)]
    public ?string $content;

    /**
     * The target URL of the action.
     */
    #[Api(optional: true)]
    public ?string $href;

    /**
     * Region specific content. See [locales docs](https://www.courier.com/docs/platform/content/elemental/locales/) for more details.
     *
     * @var array<string, Locale>|null $locales
     */
    #[Api(map: Locale::class, nullable: true, optional: true)]
    public ?array $locales;

    /**
     * Defaults to `button`.
     *
     * @var value-of<Style>|null $style
     */
    #[Api(enum: Style::class, nullable: true, optional: true)]
    public ?string $style;

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
     * @param Alignment|value-of<Alignment>|null $align
     * @param array<string, Locale>|null $locales
     * @param Style|value-of<Style>|null $style
     * @param Type|value-of<Type> $type
     */
    public static function with(
        ?string $actionID = null,
        Alignment|string|null $align = null,
        ?string $backgroundColor = null,
        ?string $content = null,
        ?string $href = null,
        ?array $locales = null,
        Style|string|null $style = null,
        Type|string|null $type = null,
    ): self {
        $obj = new self;

        null !== $actionID && $obj->actionID = $actionID;
        null !== $align && $obj['align'] = $align;
        null !== $backgroundColor && $obj->backgroundColor = $backgroundColor;
        null !== $content && $obj->content = $content;
        null !== $href && $obj->href = $href;
        null !== $locales && $obj->locales = $locales;
        null !== $style && $obj['style'] = $style;
        null !== $type && $obj['type'] = $type;

        return $obj;
    }

    /**
     * A unique id used to identify the action when it is executed.
     */
    public function withActionID(?string $actionID): self
    {
        $obj = clone $this;
        $obj->actionID = $actionID;

        return $obj;
    }

    /**
     * The alignment of the action button. Defaults to "center".
     *
     * @param Alignment|value-of<Alignment>|null $align
     */
    public function withAlign(Alignment|string|null $align): self
    {
        $obj = clone $this;
        $obj['align'] = $align;

        return $obj;
    }

    /**
     * The background color of the action button.
     */
    public function withBackgroundColor(?string $backgroundColor): self
    {
        $obj = clone $this;
        $obj->backgroundColor = $backgroundColor;

        return $obj;
    }

    /**
     * The text content of the action shown to the user.
     */
    public function withContent(string $content): self
    {
        $obj = clone $this;
        $obj->content = $content;

        return $obj;
    }

    /**
     * The target URL of the action.
     */
    public function withHref(string $href): self
    {
        $obj = clone $this;
        $obj->href = $href;

        return $obj;
    }

    /**
     * Region specific content. See [locales docs](https://www.courier.com/docs/platform/content/elemental/locales/) for more details.
     *
     * @param array<string, Locale>|null $locales
     */
    public function withLocales(?array $locales): self
    {
        $obj = clone $this;
        $obj->locales = $locales;

        return $obj;
    }

    /**
     * Defaults to `button`.
     *
     * @param Style|value-of<Style>|null $style
     */
    public function withStyle(Style|string|null $style): self
    {
        $obj = clone $this;
        $obj['style'] = $style;

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
