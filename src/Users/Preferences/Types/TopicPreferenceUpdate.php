<?php

namespace Courier\Users\Preferences\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Commons\Types\PreferenceStatus;
use Courier\Core\Json\JsonProperty;
use Courier\Commons\Types\ChannelClassification;
use Courier\Core\Types\ArrayType;

class TopicPreferenceUpdate extends JsonSerializableType
{
    /**
     * @var value-of<PreferenceStatus> $status
     */
    #[JsonProperty('status')]
    public string $status;

    /**
     * @var ?array<value-of<ChannelClassification>> $customRouting The Channels a user has chosen to receive notifications through for this topic
     */
    #[JsonProperty('custom_routing'), ArrayType(['string'])]
    public ?array $customRouting;

    /**
     * @var ?bool $hasCustomRouting
     */
    #[JsonProperty('has_custom_routing')]
    public ?bool $hasCustomRouting;

    /**
     * @param array{
     *   status: value-of<PreferenceStatus>,
     *   customRouting?: ?array<value-of<ChannelClassification>>,
     *   hasCustomRouting?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->status = $values['status'];
        $this->customRouting = $values['customRouting'] ?? null;
        $this->hasCustomRouting = $values['hasCustomRouting'] ?? null;
    }
}
