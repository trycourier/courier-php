<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Send\Traits\ElementalBaseNode;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

/**
 * The channel element allows a notification to be customized based on which channel it is sent through.
 * For example, you may want to display a detailed message when the notification is sent through email,
 * and a more concise message in a push notification. Channel elements are only valid as top-level
 * elements; you cannot nest channel elements. If there is a channel element specified at the top-level
 * of the document, all sibling elements must be channel elements.
 * Note: As an alternative, most elements support a `channel` property. Which allows you to selectively
 * display an individual element on a per channel basis. See the
 * [control flow docs](https://www.courier.com/docs/platform/content/elemental/control-flow/) for more details.
 */
class ElementalChannelNode extends JsonSerializableType
{
    use ElementalBaseNode;

    /**
     * The channel the contents of this element should be applied to. Can be `email`,
     * `push`, `direct_message`, `sms` or a provider such as slack
     *
     * @var string $channel
     */
    #[JsonProperty('channel')]
    public string $channel;

    /**
     * An array of elements to apply to the channel. If `raw` has not been
     * specified, `elements` is `required`.
     *
     * @var ?array<ElementalNode> $elements
     */
    #[JsonProperty('elements'), ArrayType([ElementalNode::class])]
    public ?array $elements;

    /**
     * Raw data to apply to the channel. If `elements` has not been
     * specified, `raw` is `required`.
     *
     * @var ?array<string, mixed> $raw
     */
    #[JsonProperty('raw'), ArrayType(['string' => 'mixed'])]
    public ?array $raw;

    /**
     * @param array{
     *   channel: string,
     *   channels?: ?array<string>,
     *   ref?: ?string,
     *   if?: ?string,
     *   loop?: ?string,
     *   elements?: ?array<ElementalNode>,
     *   raw?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->channels = $values['channels'] ?? null;
        $this->ref = $values['ref'] ?? null;
        $this->if = $values['if'] ?? null;
        $this->loop = $values['loop'] ?? null;
        $this->channel = $values['channel'];
        $this->elements = $values['elements'] ?? null;
        $this->raw = $values['raw'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
