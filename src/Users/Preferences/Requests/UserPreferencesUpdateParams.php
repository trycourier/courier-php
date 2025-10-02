<?php

namespace Courier\Users\Preferences\Requests;

use Courier\Core\Json\JsonSerializableType;
use Courier\Users\Preferences\Types\TopicPreferenceUpdate;
use Courier\Core\Json\JsonProperty;

class UserPreferencesUpdateParams extends JsonSerializableType
{
    /**
     * @var ?string $tenantId Update the preferences of a user for this specific tenant context.
     */
    public ?string $tenantId;

    /**
     * @var TopicPreferenceUpdate $topic
     */
    #[JsonProperty('topic')]
    public TopicPreferenceUpdate $topic;

    /**
     * @param array{
     *   topic: TopicPreferenceUpdate,
     *   tenantId?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->tenantId = $values['tenantId'] ?? null;
        $this->topic = $values['topic'];
    }
}
