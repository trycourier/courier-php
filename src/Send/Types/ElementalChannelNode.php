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
     * @var string $channel The channel the contents of this element should be applied to. Can be `email`,
    `push`, `direct_message`, `sms` or a provider such as slack
     */
    #[JsonProperty('channel')]
    public string $channel;

    /**
     * @var ?array<mixed> $elements An array of elements to apply to the channel. If `raw` has not been
    specified, `elements` is `required`.
     */
    #[JsonProperty('elements'), ArrayType(['mixed'])]
    public ?array $elements;

    /**
     * @var ?array<string, mixed> $raw Raw data to apply to the channel. If `elements` has not been
    specified, `raw` is `required`.
     */
    #[JsonProperty('raw'), ArrayType(['string' => 'mixed'])]
    public ?array $raw;

    /**
     * @param array{
     *   channel: string,
     *   elements?: ?array<mixed>,
     *   raw?: ?array<string, mixed>,
     *   channels?: ?array<string>,
     *   ref?: ?string,
     *   if?: ?string,
     *   loop?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->channel = $values['channel'];
        $this->elements = $values['elements'] ?? null;
        $this->raw = $values['raw'] ?? null;
        $this->channels = $values['channels'] ?? null;
        $this->ref = $values['ref'] ?? null;
        $this->if = $values['if'] ?? null;
        $this->loop = $values['loop'] ?? null;
    }
}
