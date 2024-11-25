<?php

namespace Courier\Bulk\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Send\Traits\BaseMessage;
use Courier\Core\Json\JsonProperty;
use Courier\Send\Types\Channel;
use Courier\Send\Types\MessageContext;
use Courier\Send\Types\MessageMetadata;
use Courier\Send\Types\MessagePreferences;
use Courier\Send\Types\MessageProvidersType;
use Courier\Send\Types\Routing;
use Courier\Send\Types\Timeout;
use Courier\Send\Types\Delay;
use Courier\Send\Types\Expiry;

class InboundBulkTemplateMessage extends JsonSerializableType
{
    use BaseMessage;

    /**
     * @var string $template The id of the notification template to be rendered and sent to the recipient(s).
    This field or the content field must be supplied.
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
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->template = $values['template'];
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
    }
}
