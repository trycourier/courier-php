<?php

declare(strict_types=1);

namespace Courier\Users\Preferences;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Users\Preferences\PreferenceUpdateOrCreateTopicParams\Topic;

/**
 * Update or Create user preferences for a specific subscription topic.
 *
 * @see Courier\Users\Preferences->updateOrCreateTopic
 *
 * @phpstan-type preference_update_or_create_topic_params = array{
 *   userID: string, topic: Topic, tenantID?: string|null
 * }
 */
final class PreferenceUpdateOrCreateTopicParams implements BaseModel
{
    /** @use SdkModel<preference_update_or_create_topic_params> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $userID;

    #[Api]
    public Topic $topic;

    /**
     * Update the preferences of a user for this specific tenant context.
     */
    #[Api(nullable: true, optional: true)]
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
     */
    public static function with(
        string $userID,
        Topic $topic,
        ?string $tenantID = null
    ): self {
        $obj = new self;

        $obj->userID = $userID;
        $obj->topic = $topic;

        null !== $tenantID && $obj->tenantID = $tenantID;

        return $obj;
    }

    public function withUserID(string $userID): self
    {
        $obj = clone $this;
        $obj->userID = $userID;

        return $obj;
    }

    public function withTopic(Topic $topic): self
    {
        $obj = clone $this;
        $obj->topic = $topic;

        return $obj;
    }

    /**
     * Update the preferences of a user for this specific tenant context.
     */
    public function withTenantID(?string $tenantID): self
    {
        $obj = clone $this;
        $obj->tenantID = $tenantID;

        return $obj;
    }
}
