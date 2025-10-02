<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class MessagePreferences extends JsonSerializableType
{
    /**
     * @var string $subscriptionTopicId The ID of the subscription topic you want to apply to the message. If this is a templated message, it will override the subscription topic if already associated
     */
    #[JsonProperty('subscription_topic_id')]
    public string $subscriptionTopicId;

    /**
     * @param array{
     *   subscriptionTopicId: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->subscriptionTopicId = $values['subscriptionTopicId'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
