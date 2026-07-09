<?php

declare(strict_types=1);

namespace Courier\Users\Preferences\PreferenceBulkUpdateParams;

use Courier\ChannelClassification;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Users\Preferences\PreferenceBulkUpdateParams\Topic\Status;

/**
 * @phpstan-type TopicShape = array{
 *   status: Status|value-of<Status>,
 *   topicID: string,
 *   customRouting?: list<ChannelClassification|value-of<ChannelClassification>>|null,
 *   hasCustomRouting?: bool|null,
 * }
 */
final class Topic implements BaseModel
{
    /** @use SdkModel<TopicShape> */
    use SdkModel;

    /**
     * The subscription status to apply for this topic.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * A unique identifier associated with a subscription topic.
     */
    #[Required('topic_id')]
    public string $topicID;

    /**
     * The channels a user has chosen to receive notifications through for this topic.
     *
     * @var list<value-of<ChannelClassification>>|null $customRouting
     */
    #[Optional('custom_routing', list: ChannelClassification::class)]
    public ?array $customRouting;

    /**
     * Whether the recipient has chosen specific delivery channels for this topic.
     */
    #[Optional('has_custom_routing')]
    public ?bool $hasCustomRouting;

    /**
     * `new Topic()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Topic::with(status: ..., topicID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Topic)->withStatus(...)->withTopicID(...)
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
     * @param Status|value-of<Status> $status
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $customRouting
     */
    public static function with(
        Status|string $status,
        string $topicID,
        ?array $customRouting = null,
        ?bool $hasCustomRouting = null,
    ): self {
        $self = new self;

        $self['status'] = $status;
        $self['topicID'] = $topicID;

        null !== $customRouting && $self['customRouting'] = $customRouting;
        null !== $hasCustomRouting && $self['hasCustomRouting'] = $hasCustomRouting;

        return $self;
    }

    /**
     * The subscription status to apply for this topic.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * A unique identifier associated with a subscription topic.
     */
    public function withTopicID(string $topicID): self
    {
        $self = clone $this;
        $self['topicID'] = $topicID;

        return $self;
    }

    /**
     * The channels a user has chosen to receive notifications through for this topic.
     *
     * @param list<ChannelClassification|value-of<ChannelClassification>> $customRouting
     */
    public function withCustomRouting(array $customRouting): self
    {
        $self = clone $this;
        $self['customRouting'] = $customRouting;

        return $self;
    }

    /**
     * Whether the recipient has chosen specific delivery channels for this topic.
     */
    public function withHasCustomRouting(bool $hasCustomRouting): self
    {
        $self = clone $this;
        $self['hasCustomRouting'] = $hasCustomRouting;

        return $self;
    }
}
