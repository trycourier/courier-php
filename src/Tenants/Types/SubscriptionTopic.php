<?php

namespace Courier\Tenants\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Tenants\Traits\SubscriptionTopicNew;
use Courier\Core\Json\JsonProperty;
use Courier\Commons\Types\ChannelClassification;

class SubscriptionTopic extends JsonSerializableType
{
    use SubscriptionTopicNew;

    /**
     * @var string $id Topic ID
     */
    #[JsonProperty('id')]
    public string $id;

    /**
     * @param array{
     *   id: string,
     *   status: value-of<SubscriptionTopicStatus>,
     *   hasCustomRouting?: ?bool,
     *   customRouting?: ?array<value-of<ChannelClassification>>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->status = $values['status'];
        $this->hasCustomRouting = $values['hasCustomRouting'] ?? null;
        $this->customRouting = $values['customRouting'] ?? null;
    }
}
