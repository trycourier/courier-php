<?php

declare(strict_types=1);

namespace Courier\Users\Preferences;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Tenants\DefaultPreferences\Items\ChannelClassification;

/**
 * @phpstan-type topic_preference = array{
 *   defaultStatus: value-of<PreferenceStatus>,
 *   status: value-of<PreferenceStatus>,
 *   topicID: string,
 *   topicName: string,
 *   customRouting?: list<value-of<ChannelClassification>>|null,
 *   hasCustomRouting?: bool|null,
 * }
 */
final class TopicPreference implements BaseModel
{
    /** @use SdkModel<topic_preference> */
    use SdkModel;

    /** @var value-of<PreferenceStatus> $defaultStatus */
    #[Api('default_status', enum: PreferenceStatus::class)]
    public string $defaultStatus;

    /** @var value-of<PreferenceStatus> $status */
    #[Api(enum: PreferenceStatus::class)]
    public string $status;

    #[Api('topic_id')]
    public string $topicID;

    #[Api('topic_name')]
    public string $topicName;

    /**
     * The Channels a user has chosen to receive notifications through for this topic.
     *
     * @var list<value-of<ChannelClassification>>|null $customRouting
     */
    #[Api(
        'custom_routing',
        list: ChannelClassification::class,
        nullable: true,
        optional: true,
    )]
    public ?array $customRouting;

    #[Api('has_custom_routing', nullable: true, optional: true)]
    public ?bool $hasCustomRouting;

    /**
     * `new TopicPreference()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TopicPreference::with(
     *   defaultStatus: ..., status: ..., topicID: ..., topicName: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TopicPreference)
     *   ->withDefaultStatus(...)
     *   ->withStatus(...)
     *   ->withTopicID(...)
     *   ->withTopicName(...)
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
     * @param PreferenceStatus|value-of<PreferenceStatus> $defaultStatus
     * @param PreferenceStatus|value-of<PreferenceStatus> $status
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $customRouting
     */
    public static function with(
        PreferenceStatus|string $defaultStatus,
        PreferenceStatus|string $status,
        string $topicID,
        string $topicName,
        ?array $customRouting = null,
        ?bool $hasCustomRouting = null,
    ): self {
        $obj = new self;

        $obj['defaultStatus'] = $defaultStatus;
        $obj['status'] = $status;
        $obj->topicID = $topicID;
        $obj->topicName = $topicName;

        null !== $customRouting && $obj['customRouting'] = $customRouting;
        null !== $hasCustomRouting && $obj->hasCustomRouting = $hasCustomRouting;

        return $obj;
    }

    /**
     * @param PreferenceStatus|value-of<PreferenceStatus> $defaultStatus
     */
    public function withDefaultStatus(
        PreferenceStatus|string $defaultStatus
    ): self {
        $obj = clone $this;
        $obj['defaultStatus'] = $defaultStatus;

        return $obj;
    }

    /**
     * @param PreferenceStatus|value-of<PreferenceStatus> $status
     */
    public function withStatus(PreferenceStatus|string $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }

    public function withTopicID(string $topicID): self
    {
        $obj = clone $this;
        $obj->topicID = $topicID;

        return $obj;
    }

    public function withTopicName(string $topicName): self
    {
        $obj = clone $this;
        $obj->topicName = $topicName;

        return $obj;
    }

    /**
     * The Channels a user has chosen to receive notifications through for this topic.
     *
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $customRouting
     */
    public function withCustomRouting(?array $customRouting): self
    {
        $obj = clone $this;
        $obj['customRouting'] = $customRouting;

        return $obj;
    }

    public function withHasCustomRouting(?bool $hasCustomRouting): self
    {
        $obj = clone $this;
        $obj->hasCustomRouting = $hasCustomRouting;

        return $obj;
    }
}
