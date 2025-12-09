<?php

declare(strict_types=1);

namespace Courier\Users\Preferences;

use Courier\ChannelClassification;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\PreferenceStatus;
use Courier\Users\Preferences\PreferenceUpdateOrCreateTopicParams\Topic;

/**
 * Update or Create user preferences for a specific subscription topic.
 *
 * @see Courier\Services\Users\PreferencesService::updateOrCreateTopic()
 *
 * @phpstan-type PreferenceUpdateOrCreateTopicParamsShape = array{
 *   user_id: string,
 *   topic: Topic|array{
 *     status: value-of<PreferenceStatus>,
 *     custom_routing?: list<value-of<ChannelClassification>>|null,
 *     has_custom_routing?: bool|null,
 *   },
 *   tenant_id?: string|null,
 * }
 */
final class PreferenceUpdateOrCreateTopicParams implements BaseModel
{
    /** @use SdkModel<PreferenceUpdateOrCreateTopicParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $user_id;

    #[Required]
    public Topic $topic;

    /**
     * Update the preferences of a user for this specific tenant context.
     */
    #[Optional(nullable: true)]
    public ?string $tenant_id;

    /**
     * `new PreferenceUpdateOrCreateTopicParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreferenceUpdateOrCreateTopicParams::with(user_id: ..., topic: ...)
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
     * @param Topic|array{
     *   status: value-of<PreferenceStatus>,
     *   custom_routing?: list<value-of<ChannelClassification>>|null,
     *   has_custom_routing?: bool|null,
     * } $topic
     */
    public static function with(
        string $user_id,
        Topic|array $topic,
        ?string $tenant_id = null
    ): self {
        $obj = new self;

        $obj['user_id'] = $user_id;
        $obj['topic'] = $topic;

        null !== $tenant_id && $obj['tenant_id'] = $tenant_id;

        return $obj;
    }

    public function withUserID(string $userID): self
    {
        $obj = clone $this;
        $obj['user_id'] = $userID;

        return $obj;
    }

    /**
     * @param Topic|array{
     *   status: value-of<PreferenceStatus>,
     *   custom_routing?: list<value-of<ChannelClassification>>|null,
     *   has_custom_routing?: bool|null,
     * } $topic
     */
    public function withTopic(Topic|array $topic): self
    {
        $obj = clone $this;
        $obj['topic'] = $topic;

        return $obj;
    }

    /**
     * Update the preferences of a user for this specific tenant context.
     */
    public function withTenantID(?string $tenantID): self
    {
        $obj = clone $this;
        $obj['tenant_id'] = $tenantID;

        return $obj;
    }
}
