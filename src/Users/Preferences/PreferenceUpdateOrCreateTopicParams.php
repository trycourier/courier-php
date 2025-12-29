<?php

declare(strict_types=1);

namespace Courier\Users\Preferences;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Users\Preferences\PreferenceUpdateOrCreateTopicParams\Topic;

/**
 * Update or Create user preferences for a specific subscription topic.
 *
 * @see Courier\Services\Users\PreferencesService::updateOrCreateTopic()
 *
 * @phpstan-import-type TopicShape from \Courier\Users\Preferences\PreferenceUpdateOrCreateTopicParams\Topic
 *
 * @phpstan-type PreferenceUpdateOrCreateTopicParamsShape = array{
 *   userID: string, topic: Topic|TopicShape, tenantID?: string|null
 * }
 */
final class PreferenceUpdateOrCreateTopicParams implements BaseModel
{
    /** @use SdkModel<PreferenceUpdateOrCreateTopicParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $userID;

    #[Required]
    public Topic $topic;

    /**
     * Update the preferences of a user for this specific tenant context.
     */
    #[Optional(nullable: true)]
    public ?string $tenantID;

    /**
     * `new PreferenceUpdateOrCreateTopicParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreferenceUpdateOrCreateTopicParams::with(userID: ..., topic: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreferenceUpdateOrCreateTopicParams)->withUserID(...)->withTopic(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Topic|TopicShape $topic
     */
    public static function with(
        string $userID,
        Topic|array $topic,
        ?string $tenantID = null
    ): self {
        $self = new self;

        $self['userID'] = $userID;
        $self['topic'] = $topic;

        null !== $tenantID && $self['tenantID'] = $tenantID;

        return $self;
    }

    public function withUserID(string $userID): self
    {
        $self = clone $this;
        $self['userID'] = $userID;

        return $self;
    }

    /**
     * @param Topic|TopicShape $topic
     */
    public function withTopic(Topic|array $topic): self
    {
        $self = clone $this;
        $self['topic'] = $topic;

        return $self;
    }

    /**
     * Update the preferences of a user for this specific tenant context.
     */
    public function withTenantID(?string $tenantID): self
    {
        $self = clone $this;
        $self['tenantID'] = $tenantID;

        return $self;
    }
}
