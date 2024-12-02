<?php

namespace Courier\Automations\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Automations\Traits\AutomationStep;
use Courier\Core\Json\JsonProperty;

class AutomationAddToDigestStep extends JsonSerializableType
{
    use AutomationStep;

    /**
     * @var string $action
     */
    #[JsonProperty('action')]
    public string $action;

    /**
     * @var string $subscriptionTopicId The subscription topic that has digests enabled
     */
    #[JsonProperty('subscription_topic_id')]
    public string $subscriptionTopicId;

    /**
     * @param array{
     *   action: string,
     *   subscriptionTopicId: string,
     *   if?: ?string,
     *   ref?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->action = $values['action'];
        $this->subscriptionTopicId = $values['subscriptionTopicId'];
        $this->if = $values['if'] ?? null;
        $this->ref = $values['ref'] ?? null;
    }
}
