<?php

namespace Courier\Users\Preferences\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class UserPreferencesGetResponse extends JsonSerializableType
{
    /**
     * @var TopicPreference $topic
     */
    #[JsonProperty('topic')]
    public TopicPreference $topic;

    /**
     * @param array{
     *   topic: TopicPreference,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->topic = $values['topic'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
