<?php

namespace Courier\Users\Preferences\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Commons\Types\ChannelClassification;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;
use Courier\Commons\Types\PreferenceStatus;

class TopicPreference extends JsonSerializableType
{
    /**
     * @var ?array<value-of<ChannelClassification>> $customRouting The Channels a user has chosen to receive notifications through for this topic
     */
    #[JsonProperty('custom_routing'), ArrayType(['string'])]
    public ?array $customRouting;

    /**
     * @var value-of<PreferenceStatus> $defaultStatus
     */
    #[JsonProperty('default_status')]
    public string $defaultStatus;

    /**
     * @var ?bool $hasCustomRouting
     */
    #[JsonProperty('has_custom_routing')]
    public ?bool $hasCustomRouting;

    /**
     * @var value-of<PreferenceStatus> $status
     */
    #[JsonProperty('status')]
    public string $status;

    /**
     * @var string $topicId
     */
    #[JsonProperty('topic_id')]
    public string $topicId;

    /**
     * @var string $topicName
     */
    #[JsonProperty('topic_name')]
    public string $topicName;

    /**
     * @param array{
     *   customRouting?: ?array<value-of<ChannelClassification>>,
     *   defaultStatus: value-of<PreferenceStatus>,
     *   hasCustomRouting?: ?bool,
     *   status: value-of<PreferenceStatus>,
     *   topicId: string,
     *   topicName: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->customRouting = $values['customRouting'] ?? null;
        $this->defaultStatus = $values['defaultStatus'];
        $this->hasCustomRouting = $values['hasCustomRouting'] ?? null;
        $this->status = $values['status'];
        $this->topicId = $values['topicId'];
        $this->topicName = $values['topicName'];
    }
}
