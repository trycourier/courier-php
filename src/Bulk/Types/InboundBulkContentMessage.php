<?php

namespace Courier\Bulk\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Send\Traits\BaseMessage;
use Courier\Send\Types\ElementalContent;
use Courier\Send\Types\ElementalContentSugar;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\Union;
use Courier\Send\Types\Channel;
use Courier\Send\Types\MessageContext;
use Courier\Send\Types\MessageMetadata;
use Courier\Send\Types\MessagePreferences;
use Courier\Send\Types\MessageProvidersType;
use Courier\Send\Types\Routing;
use Courier\Send\Types\Timeout;
use Courier\Send\Types\Delay;
use Courier\Send\Types\Expiry;

/**
 * The message property has the following primary top-level properties. They define the destination and content of the message.
 * Additional advanced configuration fields [are defined below](https://www.courier.com/docs/reference/send/message/#other-message-properties).
 */
class InboundBulkContentMessage extends JsonSerializableType
{
    use BaseMessage;

    /**
     * Describes the content of the message in a way that will work for email, push,
     * chat, or any channel. Either this or template must be specified.
     *
     * @var (
     *    ElementalContent
     *   |ElementalContentSugar
     * ) $content
     */
    #[JsonProperty('content'), Union(ElementalContent::class, ElementalContentSugar::class)]
    public ElementalContent|ElementalContentSugar $content;

    /**
     * @param array{
     *   content: (
     *    ElementalContent
     *   |ElementalContentSugar
     * ),
     *   data?: ?array<string, mixed>,
     *   brandId?: ?string,
     *   channels?: ?array<string, Channel>,
     *   context?: ?MessageContext,
     *   metadata?: ?MessageMetadata,
     *   preferences?: ?MessagePreferences,
     *   providers?: ?array<string, MessageProvidersType>,
     *   routing?: ?Routing,
     *   timeout?: ?Timeout,
     *   delay?: ?Delay,
     *   expiry?: ?Expiry,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->data = $values['data'] ?? null;
        $this->brandId = $values['brandId'] ?? null;
        $this->channels = $values['channels'] ?? null;
        $this->context = $values['context'] ?? null;
        $this->metadata = $values['metadata'] ?? null;
        $this->preferences = $values['preferences'] ?? null;
        $this->providers = $values['providers'] ?? null;
        $this->routing = $values['routing'] ?? null;
        $this->timeout = $values['timeout'] ?? null;
        $this->delay = $values['delay'] ?? null;
        $this->expiry = $values['expiry'] ?? null;
        $this->content = $values['content'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
