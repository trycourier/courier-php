<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Commons\Types\PreferenceStatus;
use Courier\Core\Json\JsonProperty;
use Courier\Commons\Types\Rule;
use Courier\Core\Types\ArrayType;
use Courier\Commons\Types\ChannelPreference;

class Preference extends JsonSerializableType
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
     * @var ?value-of<ChannelSource> $source
     */
    #[JsonProperty('source')]
    public ?string $source;

    /**
     * @param array{
     *   status: value-of<PreferenceStatus>,
     *   rules?: ?array<Rule>,
     *   channelPreferences?: ?array<ChannelPreference>,
     *   source?: ?value-of<ChannelSource>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->status = $values['status'];
        $this->rules = $values['rules'] ?? null;
        $this->channelPreferences = $values['channelPreferences'] ?? null;
        $this->source = $values['source'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
