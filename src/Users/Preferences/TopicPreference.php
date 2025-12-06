<?php

declare(strict_types=1);

namespace Courier\Users\Preferences;

use Courier\ChannelClassification;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\PreferenceStatus;

/**
 * @phpstan-type TopicPreferenceShape = array{
 *   default_status: value-of<PreferenceStatus>,
 *   status: value-of<PreferenceStatus>,
 *   topic_id: string,
 *   topic_name: string,
 *   custom_routing?: list<value-of<ChannelClassification>>|null,
 *   has_custom_routing?: bool|null,
 * }
 */
final class TopicPreference implements BaseModel
{
    /** @use SdkModel<TopicPreferenceShape> */
    use SdkModel;

    /** @var value-of<PreferenceStatus> $default_status */
    #[Api(enum: PreferenceStatus::class)]
    public string $default_status;

    /** @var value-of<PreferenceStatus> $status */
    #[Api(enum: PreferenceStatus::class)]
    public string $status;

    #[Api]
    public string $topic_id;

    #[Api]
    public string $topic_name;

    /**
     * The Channels a user has chosen to receive notifications through for this topic.
     *
     * @var list<value-of<ChannelClassification>>|null $custom_routing
     */
    #[Api(list: ChannelClassification::class, nullable: true, optional: true)]
    public ?array $custom_routing;

    #[Api(nullable: true, optional: true)]
    public ?bool $has_custom_routing;

    /**
     * `new TopicPreference()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TopicPreference::with(
     *   default_status: ..., status: ..., topic_id: ..., topic_name: ...
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
     * @param PreferenceStatus|value-of<PreferenceStatus> $default_status
     * @param PreferenceStatus|value-of<PreferenceStatus> $status
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $custom_routing
     */
    public static function with(
        PreferenceStatus|string $default_status,
        PreferenceStatus|string $status,
        string $topic_id,
        string $topic_name,
        ?array $custom_routing = null,
        ?bool $has_custom_routing = null,
    ): self {
        $obj = new self;

        $obj['default_status'] = $default_status;
        $obj['status'] = $status;
        $obj['topic_id'] = $topic_id;
        $obj['topic_name'] = $topic_name;

        null !== $custom_routing && $obj['custom_routing'] = $custom_routing;
        null !== $has_custom_routing && $obj['has_custom_routing'] = $has_custom_routing;

        return $obj;
    }

    /**
     * @param PreferenceStatus|value-of<PreferenceStatus> $defaultStatus
     */
    public function withDefaultStatus(
        PreferenceStatus|string $defaultStatus
    ): self {
        $obj = clone $this;
        $obj['default_status'] = $defaultStatus;

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
        $obj['topic_id'] = $topicID;

        return $obj;
    }

    public function withTopicName(string $topicName): self
    {
        $obj = clone $this;
        $obj['topic_name'] = $topicName;

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
        $obj['custom_routing'] = $customRouting;

        return $obj;
    }

    public function withHasCustomRouting(?bool $hasCustomRouting): self
    {
        $obj = clone $this;
        $obj['has_custom_routing'] = $hasCustomRouting;

        return $obj;
    }
}
