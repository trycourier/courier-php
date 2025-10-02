<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Profiles\Types\WebhookProfile;
use Courier\Core\Json\JsonProperty;

class WebhookRecipient extends JsonSerializableType
{
    /**
     * @var WebhookProfile $webhook
     */
    #[JsonProperty('webhook')]
    public WebhookProfile $webhook;

    /**
     * @param array{
     *   webhook: WebhookProfile,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->webhook = $values['webhook'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
