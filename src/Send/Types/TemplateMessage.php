<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Send\Traits\BaseMessage;
use Courier\Send\Traits\BaseMessageSendTo;
use Courier\Core\Json\JsonProperty;

class TemplateMessage extends JsonSerializableType
{
    use BaseMessage;
    use BaseMessageSendTo;

    /**
     * The id of the notification template to be rendered and sent to the recipient(s).
     * This field or the content field must be supplied.
     *
     * @var string $template
     */
    #[JsonProperty('template')]
    public string $template;

    /**
     * @param array{
     *   template: string,
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
     *   to?: (
     *    AudienceRecipient
     *   |ListRecipient
     *   |ListPatternRecipient
     *   |UserRecipient
     *   |SlackRecipient
     *   |MsTeamsRecipient
     *   |array<string, mixed>
     *   |PagerdutyRecipient
     *   |WebhookRecipient
     *   |array<(
     *    AudienceRecipient
     *   |ListRecipient
     *   |ListPatternRecipient
     *   |UserRecipient
     *   |SlackRecipient
     *   |MsTeamsRecipient
     *   |array<string, mixed>
     *   |PagerdutyRecipient
     *   |WebhookRecipient
     * )>
     * )|null,
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
        $this->to = $values['to'] ?? null;
        $this->template = $values['template'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
