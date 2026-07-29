<?php

declare(strict_types=1);

namespace Courier\Users\Preferences\PreferenceUpdateOrCreateTopicParams;

use Courier\ChannelClassification;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\PreferenceStatus;

/**
 * @phpstan-type TopicShape = array{
 *   status: PreferenceStatus|value-of<PreferenceStatus>,
 *   customRouting?: list<ChannelClassification|value-of<ChannelClassification>>|null,
 *   hasCustomRouting?: bool|null,
 * }
 */
final class Topic implements BaseModel
{
    /** @use SdkModel<TopicShape> */
    use SdkModel;

    /**
     * The subscription status to set: OPTED_IN or OPTED_OUT. REQUIRED is a topic-level default, not a user choice; the API rejects opting a user out of a REQUIRED topic.
     *
     * @var value-of<PreferenceStatus> $status
     */
    #[Required(enum: PreferenceStatus::class)]
    public string $status;

    /**
     * The channels to deliver this topic on when has_custom_routing is true. One or more of: direct_message, email, push, sms, webhook, inbox.
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
     * Set to true to route this topic to the channels in custom_routing instead of the topic's default routing.
     */
    #[Optional('has_custom_routing', nullable: true)]
    public ?bool $hasCustomRouting;

    /**
     * `new Topic()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Topic::with(status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Topic)->withStatus(...)
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
     * @param PreferenceStatus|value-of<PreferenceStatus> $status
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $customRouting
     */
    public static function with(
        PreferenceStatus|string $status,
        ?array $customRouting = null,
        ?bool $hasCustomRouting = null,
    ): self {
        $self = new self;

        $self['status'] = $status;

        null !== $customRouting && $self['customRouting'] = $customRouting;
        null !== $hasCustomRouting && $self['hasCustomRouting'] = $hasCustomRouting;

        return $self;
    }

    /**
     * The subscription status to set: OPTED_IN or OPTED_OUT. REQUIRED is a topic-level default, not a user choice; the API rejects opting a user out of a REQUIRED topic.
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
     * The channels to deliver this topic on when has_custom_routing is true. One or more of: direct_message, email, push, sms, webhook, inbox.
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
     * Set to true to route this topic to the channels in custom_routing instead of the topic's default routing.
     */
    public function withHasCustomRouting(?bool $hasCustomRouting): self
    {
        $self = clone $this;
        $self['hasCustomRouting'] = $hasCustomRouting;

        return $self;
    }
}
