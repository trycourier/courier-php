<?php

namespace Courier\Commons\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class NotificationPreferenceDetails extends JsonSerializableType
{
    /**
     * @var value-of<PreferenceStatus> $status
     */
    #[JsonProperty('status')]
    public string $status;

    /**
     * @var ?array<Rule> $rules
     */
    #[JsonProperty('rules'), ArrayType([Rule::class])]
    public ?array $rules;

    /**
     * @var ?array<ChannelPreference> $channelPreferences
     */
    #[JsonProperty('channel_preferences'), ArrayType([ChannelPreference::class])]
    public ?array $channelPreferences;

    /**
     * @param array{
     *   status: value-of<PreferenceStatus>,
     *   rules?: ?array<Rule>,
     *   channelPreferences?: ?array<ChannelPreference>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->status = $values['status'];
        $this->rules = $values['rules'] ?? null;
        $this->channelPreferences = $values['channelPreferences'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
