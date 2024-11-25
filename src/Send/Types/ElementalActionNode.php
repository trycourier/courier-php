<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Send\Traits\ElementalBaseNode;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

/**
 * Allows the user to execute an action. Can be a button or a link.
 */
class ElementalActionNode extends JsonSerializableType
{
    use ElementalBaseNode;

    /**
     * @var string $content The text content of the action shown to the user.
     */
    #[JsonProperty('content')]
    public string $content;

    /**
     * @var string $href The target URL of the action.
     */
    #[JsonProperty('href')]
    public string $href;

    /**
     * @var ?string $actionId A unique id used to identify the action when it is executed.
     */
    #[JsonProperty('action_id')]
    public ?string $actionId;

    /**
     * @var ?value-of<IAlignment> $align The alignment of the action button. Defaults to "center".
     */
    #[JsonProperty('align')]
    public ?string $align;

    /**
     * @var ?string $backgroundColor The background color of the action button.
     */
    #[JsonProperty('background_color')]
    public ?string $backgroundColor;

    /**
     * @var ?value-of<IActionButtonStyle> $style Defaults to `button`.
     */
    #[JsonProperty('style')]
    public ?string $style;

    /**
     * @var ?array<string, Locale> $locales Region specific content. See [locales docs](https://www.courier.com/docs/platform/content/elemental/locales/) for more details.
     */
    #[JsonProperty('locales'), ArrayType(['string' => Locale::class])]
    public ?array $locales;

    /**
     * @param array{
     *   content: string,
     *   href: string,
     *   actionId?: ?string,
     *   align?: ?value-of<IAlignment>,
     *   backgroundColor?: ?string,
     *   style?: ?value-of<IActionButtonStyle>,
     *   locales?: ?array<string, Locale>,
     *   channels?: ?array<string>,
     *   ref?: ?string,
     *   if?: ?string,
     *   loop?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->content = $values['content'];
        $this->href = $values['href'];
        $this->actionId = $values['actionId'] ?? null;
        $this->align = $values['align'] ?? null;
        $this->backgroundColor = $values['backgroundColor'] ?? null;
        $this->style = $values['style'] ?? null;
        $this->locales = $values['locales'] ?? null;
        $this->channels = $values['channels'] ?? null;
        $this->ref = $values['ref'] ?? null;
        $this->if = $values['if'] ?? null;
        $this->loop = $values['loop'] ?? null;
    }
}
