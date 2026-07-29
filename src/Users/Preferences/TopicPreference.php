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
 *   defaultStatus: PreferenceStatus|value-of<PreferenceStatus>,
 *   status: PreferenceStatus|value-of<PreferenceStatus>,
 *   topicID: string,
 *   topicName: string,
 *   customRouting?: list<ChannelClassification|value-of<ChannelClassification>>|null,
 *   hasCustomRouting?: bool|null,
 * }
 */
final class TopicPreference implements BaseModel
{
    /** @use SdkModel<TopicPreferenceShape> */
    use SdkModel;

    /**
     * The topic's default status, returned on reads. It applies whenever the user has no override of their own (status equals this value).
     *
     * @var value-of<PreferenceStatus> $defaultStatus
     */
    #[Required('default_status', enum: PreferenceStatus::class)]
    public string $defaultStatus;

    /**
     * The user's subscription status for this topic. OPTED_IN or OPTED_OUT reflect the user's own choice; REQUIRED is a topic-level default set in the preferences editor, not a user choice.
     *
     * @var value-of<PreferenceStatus> $status
     */
    #[Required(enum: PreferenceStatus::class)]
    public string $status;

    /**
     * The unique identifier of the subscription topic this preference applies to.
     */
    #[Required('topic_id')]
    public string $topicID;

    /**
     * The display name of the subscription topic, returned on reads.
     */
    #[Required('topic_name')]
    public string $topicName;

    /**
     * The channels the user has chosen to receive this topic on, present only when has_custom_routing is true. One or more of: direct_message, email, push, sms, webhook, inbox.
     *
     * @var list<value-of<ChannelClassification>>|null $customRouting
     */
    #[Optional(
        'custom_routing',
        list: ChannelClassification::class,
        nullable: true
    )]
    public ?array $customRouting;

    /**
     * Whether the user has chosen specific delivery channels for this topic (listed in custom_routing) rather than the topic's default routing.
     */
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
     * The topic's default status, returned on reads. It applies whenever the user has no override of their own (status equals this value).
     *
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
     * The user's subscription status for this topic. OPTED_IN or OPTED_OUT reflect the user's own choice; REQUIRED is a topic-level default set in the preferences editor, not a user choice.
     *
     * @param PreferenceStatus|value-of<PreferenceStatus> $status
     */
    public function withStatus(PreferenceStatus|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * The unique identifier of the subscription topic this preference applies to.
     */
    public function withTopicID(string $topicID): self
    {
        $self = clone $this;
        $self['topicID'] = $topicID;

        return $self;
    }

    /**
     * The display name of the subscription topic, returned on reads.
     */
    public function withTopicName(string $topicName): self
    {
        $self = clone $this;
        $self['topicName'] = $topicName;

        return $self;
    }

    /**
     * The channels the user has chosen to receive this topic on, present only when has_custom_routing is true. One or more of: direct_message, email, push, sms, webhook, inbox.
     *
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $customRouting
     */
    public function withCustomRouting(?array $customRouting): self
    {
        $self = clone $this;
        $self['customRouting'] = $customRouting;

        return $self;
    }

    /**
     * Whether the user has chosen specific delivery channels for this topic (listed in custom_routing) rather than the topic's default routing.
     */
    public function withHasCustomRouting(?bool $hasCustomRouting): self
    {
        $self = clone $this;
        $self['hasCustomRouting'] = $hasCustomRouting;

        return $self;
    }
}
