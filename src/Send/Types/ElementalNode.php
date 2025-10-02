<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Exception;
use Courier\Core\Json\JsonDecoder;

class ElementalNode extends JsonSerializableType
{
    /**
     * @var (
     *    'text'
     *   |'meta'
     *   |'channel'
     *   |'image'
     *   |'action'
     *   |'divider'
     *   |'group'
     *   |'quote'
     *   |'_unknown'
     * ) $type
     */
    public readonly string $type;

    /**
     * @var (
     *    ElementalTextNode
     *   |ElementalMetaNode
     *   |ElementalChannelNode
     *   |ElementalImageNode
     *   |ElementalActionNode
     *   |ElementalDividerNode
     *   |ElementalGroupNode
     *   |ElementalQuoteNode
     *   |mixed
     * ) $value
     */
    public readonly mixed $value;

    /**
     * @param array{
     *   type: (
     *    'text'
     *   |'meta'
     *   |'channel'
     *   |'image'
     *   |'action'
     *   |'divider'
     *   |'group'
     *   |'quote'
     *   |'_unknown'
     * ),
     *   value: (
     *    ElementalTextNode
     *   |ElementalMetaNode
     *   |ElementalChannelNode
     *   |ElementalImageNode
     *   |ElementalActionNode
     *   |ElementalDividerNode
     *   |ElementalGroupNode
     *   |ElementalQuoteNode
     *   |mixed
     * ),
     * } $values
     */
    private function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->value = $values['value'];
    }

    /**
     * @param ElementalTextNode $text
     * @return ElementalNode
     */
    public static function text(ElementalTextNode $text): ElementalNode
    {
        return new ElementalNode([
            'type' => 'text',
            'value' => $text,
        ]);
    }

    /**
     * @param ElementalMetaNode $meta
     * @return ElementalNode
     */
    public static function meta(ElementalMetaNode $meta): ElementalNode
    {
        return new ElementalNode([
            'type' => 'meta',
            'value' => $meta,
        ]);
    }

    /**
     * @param ElementalChannelNode $channel
     * @return ElementalNode
     */
    public static function channel(ElementalChannelNode $channel): ElementalNode
    {
        return new ElementalNode([
            'type' => 'channel',
            'value' => $channel,
        ]);
    }

    /**
     * @param ElementalImageNode $image
     * @return ElementalNode
     */
    public static function image(ElementalImageNode $image): ElementalNode
    {
        return new ElementalNode([
            'type' => 'image',
            'value' => $image,
        ]);
    }

    /**
     * @param ElementalActionNode $action
     * @return ElementalNode
     */
    public static function action(ElementalActionNode $action): ElementalNode
    {
        return new ElementalNode([
            'type' => 'action',
            'value' => $action,
        ]);
    }

    /**
     * @param ElementalDividerNode $divider
     * @return ElementalNode
     */
    public static function divider(ElementalDividerNode $divider): ElementalNode
    {
        return new ElementalNode([
            'type' => 'divider',
            'value' => $divider,
        ]);
    }

    /**
     * @param ElementalGroupNode $group
     * @return ElementalNode
     */
    public static function group(ElementalGroupNode $group): ElementalNode
    {
        return new ElementalNode([
            'type' => 'group',
            'value' => $group,
        ]);
    }

    /**
     * @param ElementalQuoteNode $quote
     * @return ElementalNode
     */
    public static function quote(ElementalQuoteNode $quote): ElementalNode
    {
        return new ElementalNode([
            'type' => 'quote',
            'value' => $quote,
        ]);
    }

    /**
     * @return bool
     */
    public function isText(): bool
    {
        return $this->value instanceof ElementalTextNode && $this->type === 'text';
    }

    /**
     * @return ElementalTextNode
     */
    public function asText(): ElementalTextNode
    {
        if (!($this->value instanceof ElementalTextNode && $this->type === 'text')) {
            throw new Exception(
                "Expected text; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isMeta(): bool
    {
        return $this->value instanceof ElementalMetaNode && $this->type === 'meta';
    }

    /**
     * @return ElementalMetaNode
     */
    public function asMeta(): ElementalMetaNode
    {
        if (!($this->value instanceof ElementalMetaNode && $this->type === 'meta')) {
            throw new Exception(
                "Expected meta; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isChannel(): bool
    {
        return $this->value instanceof ElementalChannelNode && $this->type === 'channel';
    }

    /**
     * @return ElementalChannelNode
     */
    public function asChannel(): ElementalChannelNode
    {
        if (!($this->value instanceof ElementalChannelNode && $this->type === 'channel')) {
            throw new Exception(
                "Expected channel; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isImage(): bool
    {
        return $this->value instanceof ElementalImageNode && $this->type === 'image';
    }

    /**
     * @return ElementalImageNode
     */
    public function asImage(): ElementalImageNode
    {
        if (!($this->value instanceof ElementalImageNode && $this->type === 'image')) {
            throw new Exception(
                "Expected image; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isAction(): bool
    {
        return $this->value instanceof ElementalActionNode && $this->type === 'action';
    }

    /**
     * @return ElementalActionNode
     */
    public function asAction(): ElementalActionNode
    {
        if (!($this->value instanceof ElementalActionNode && $this->type === 'action')) {
            throw new Exception(
                "Expected action; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isDivider(): bool
    {
        return $this->value instanceof ElementalDividerNode && $this->type === 'divider';
    }

    /**
     * @return ElementalDividerNode
     */
    public function asDivider(): ElementalDividerNode
    {
        if (!($this->value instanceof ElementalDividerNode && $this->type === 'divider')) {
            throw new Exception(
                "Expected divider; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isGroup(): bool
    {
        return $this->value instanceof ElementalGroupNode && $this->type === 'group';
    }

    /**
     * @return ElementalGroupNode
     */
    public function asGroup(): ElementalGroupNode
    {
        if (!($this->value instanceof ElementalGroupNode && $this->type === 'group')) {
            throw new Exception(
                "Expected group; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isQuote(): bool
    {
        return $this->value instanceof ElementalQuoteNode && $this->type === 'quote';
    }

    /**
     * @return ElementalQuoteNode
     */
    public function asQuote(): ElementalQuoteNode
    {
        if (!($this->value instanceof ElementalQuoteNode && $this->type === 'quote')) {
            throw new Exception(
                "Expected quote; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }

    /**
     * @return array<mixed>
     */
    public function jsonSerialize(): array
    {
        $result = [];
        $result['type'] = $this->type;

        $base = parent::jsonSerialize();
        $result = array_merge($base, $result);

        switch ($this->type) {
            case 'text':
                $value = $this->asText()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'meta':
                $value = $this->asMeta()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'channel':
                $value = $this->asChannel()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'image':
                $value = $this->asImage()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'action':
                $value = $this->asAction()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'divider':
                $value = $this->asDivider()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'group':
                $value = $this->asGroup()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'quote':
                $value = $this->asQuote()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case '_unknown':
            default:
                if (is_null($this->value)) {
                    break;
                }
                if ($this->value instanceof JsonSerializableType) {
                    $value = $this->value->jsonSerialize();
                    $result = array_merge($value, $result);
                } elseif (is_array($this->value)) {
                    $result = array_merge($this->value, $result);
                }
        }

        return $result;
    }

    /**
     * @param string $json
     */
    public static function fromJson(string $json): static
    {
        $decodedJson = JsonDecoder::decode($json);
        if (!is_array($decodedJson)) {
            throw new Exception("Unexpected non-array decoded type: " . gettype($decodedJson));
        }
        return self::jsonDeserialize($decodedJson);
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function jsonDeserialize(array $data): static
    {
        $args = [];
        if (!array_key_exists('type', $data)) {
            throw new Exception(
                "JSON data is missing property 'type'",
            );
        }
        $type = $data['type'];
        if (!(is_string($type))) {
            throw new Exception(
                "Expected property 'type' in JSON data to be string, instead received " . get_debug_type($data['type']),
            );
        }

        $args['type'] = $type;
        switch ($type) {
            case 'text':
                $args['value'] = ElementalTextNode::jsonDeserialize($data);
                break;
            case 'meta':
                $args['value'] = ElementalMetaNode::jsonDeserialize($data);
                break;
            case 'channel':
                $args['value'] = ElementalChannelNode::jsonDeserialize($data);
                break;
            case 'image':
                $args['value'] = ElementalImageNode::jsonDeserialize($data);
                break;
            case 'action':
                $args['value'] = ElementalActionNode::jsonDeserialize($data);
                break;
            case 'divider':
                $args['value'] = ElementalDividerNode::jsonDeserialize($data);
                break;
            case 'group':
                $args['value'] = ElementalGroupNode::jsonDeserialize($data);
                break;
            case 'quote':
                $args['value'] = ElementalQuoteNode::jsonDeserialize($data);
                break;
            case '_unknown':
            default:
                $args['type'] = '_unknown';
                $args['value'] = $data;
        }

        // @phpstan-ignore-next-line
        return new static($args);
    }
}
