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
     *   status: value-of<SubscriptionTopicStatus>,
     *   id: string,
     *   hasCustomRouting?: ?bool,
     *   customRouting?: ?array<value-of<ChannelClassification>>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->status = $values['status'];
        $this->hasCustomRouting = $values['hasCustomRouting'] ?? null;
        $this->customRouting = $values['customRouting'] ?? null;
        $this->id = $values['id'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
