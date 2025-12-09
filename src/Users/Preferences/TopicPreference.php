<?php

declare(strict_types=1);

namespace Courier\Users\Preferences;

use Courier\ChannelClassification;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\PreferenceStatus;

/**
 * @phpstan-type TopicPreferenceShape = array{
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
    /** @use SdkModel<TopicPreferenceShape> */
    use SdkModel;

    /** @var value-of<PreferenceStatus> $defaultStatus */
    #[Required('default_status', enum: PreferenceStatus::class)]
    public string $defaultStatus;

    /** @var value-of<PreferenceStatus> $status */
    #[Required(enum: PreferenceStatus::class)]
    public string $status;

    #[Required('topic_id')]
    public string $topicID;

    #[Required('topic_name')]
    public string $topicName;

    /**
     * The Channels a user has chosen to receive notifications through for this topic.
     *
     * @var list<value-of<ChannelClassification>>|null $customRouting
     */
    #[Optional(
        'custom_routing',
        list: ChannelClassification::class,
        nullable: true
    )]
    public ?array $customRouting;

    #[Optional('has_custom_routing', nullable: true)]
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
        $self = new self;

        $self['defaultStatus'] = $defaultStatus;
        $self['status'] = $status;
        $self['topicID'] = $topicID;
        $self['topicName'] = $topicName;

        null !== $customRouting && $self['customRouting'] = $customRouting;
        null !== $hasCustomRouting && $self['hasCustomRouting'] = $hasCustomRouting;

        return $self;
    }

    /**
     * @param PreferenceStatus|value-of<PreferenceStatus> $defaultStatus
     */
    public function withDefaultStatus(
        PreferenceStatus|string $defaultStatus
    ): self {
        $self = clone $this;
        $self['defaultStatus'] = $defaultStatus;

        return $self;
    }

    /**
     * @param PreferenceStatus|value-of<PreferenceStatus> $status
     */
    public function withStatus(PreferenceStatus|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    public function withTopicID(string $topicID): self
    {
        $self = clone $this;
        $self['topicID'] = $topicID;

        return $self;
    }

    public function withTopicName(string $topicName): self
    {
        $self = clone $this;
        $self['topicName'] = $topicName;

        return $self;
    }

    /**
     * The Channels a user has chosen to receive notifications through for this topic.
     *
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $customRouting
     */
    public function withCustomRouting(?array $customRouting): self
    {
        $self = clone $this;
        $self['customRouting'] = $customRouting;

        return $self;
    }

    public function withHasCustomRouting(?bool $hasCustomRouting): self
    {
        $self = clone $this;
        $self['hasCustomRouting'] = $hasCustomRouting;

        return $self;
    }
}
