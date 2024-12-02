<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Send\Traits\BaseMessage;
use Courier\Send\Traits\BaseMessageSendTo;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\Union;

/**
 * The message property has the following primary top-level properties. They define the destination and content of the message.
 * Additional advanced configuration fields [are defined below](https://www.courier.com/docs/reference/send/message/#other-message-properties).
 */
class ContentMessage extends JsonSerializableType
{
    use BaseMessage;
    use BaseMessageSendTo;

    /**
     * @var ElementalContent|ElementalContentSugar $content Describes the content of the message in a way that will work for email, push,
    chat, or any channel. Either this or template must be specified.
     */
    #[JsonProperty('content'), Union(ElementalContent::class, ElementalContentSugar::class)]
    public ElementalContent|ElementalContentSugar $content;

    /**
     * @param array{
     *   content: ElementalContent|ElementalContentSugar,
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
     *   to?: AudienceRecipient|ListRecipient|ListPatternRecipient|UserRecipient|SlackRecipient|MsTeamsRecipient|array<string, mixed>|PagerdutyRecipient|WebhookRecipient|array<AudienceRecipient|ListRecipient|ListPatternRecipient|UserRecipient|SlackRecipient|MsTeamsRecipient|array<string, mixed>|PagerdutyRecipient|WebhookRecipient>|null,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->content = $values['content'];
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
        $this->to = $values['to'] ?? null;
    }
}
