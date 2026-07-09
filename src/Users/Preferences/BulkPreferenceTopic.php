<?php

declare(strict_types=1);

namespace Courier\Users\Preferences;

use Courier\ChannelClassification;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Users\Preferences\BulkPreferenceTopic\Status;

/**
 * A single topic override echoed in a bulk preference response.
 *
 * @phpstan-type BulkPreferenceTopicShape = array{
 *   customRouting: list<ChannelClassification|value-of<ChannelClassification>>,
 *   hasCustomRouting: bool,
 *   status: Status|value-of<Status>,
 *   topicID: string,
 * }
 */
final class BulkPreferenceTopic implements BaseModel
{
    /** @use SdkModel<BulkPreferenceTopicShape> */
    use SdkModel;

    /** @var list<value-of<ChannelClassification>> $customRouting */
    #[Required('custom_routing', list: ChannelClassification::class)]
    public array $customRouting;

    #[Required('has_custom_routing')]
    public bool $hasCustomRouting;

    /**
     * The applied subscription status. Echoes the requested value, so it is always OPTED_IN or OPTED_OUT.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    #[Required('topic_id')]
    public string $topicID;

    /**
     * `new BulkPreferenceTopic()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BulkPreferenceTopic::with(
     *   customRouting: ..., hasCustomRouting: ..., status: ..., topicID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BulkPreferenceTopic)
     *   ->withCustomRouting(...)
     *   ->withHasCustomRouting(...)
     *   ->withStatus(...)
     *   ->withTopicID(...)
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
     * @param list<ChannelClassification|value-of<ChannelClassification>> $customRouting
     * @param Status|value-of<Status> $status
     */
    public static function with(
        array $customRouting,
        bool $hasCustomRouting,
        Status|string $status,
        string $topicID,
    ): self {
        $self = new self;

        $self['customRouting'] = $customRouting;
        $self['hasCustomRouting'] = $hasCustomRouting;
        $self['status'] = $status;
        $self['topicID'] = $topicID;

        return $self;
    }

    /**
     * @param list<ChannelClassification|value-of<ChannelClassification>> $customRouting
     */
    public function withCustomRouting(array $customRouting): self
    {
        $self = clone $this;
        $self['customRouting'] = $customRouting;

        return $self;
    }

    public function withHasCustomRouting(bool $hasCustomRouting): self
    {
        $self = clone $this;
        $self['hasCustomRouting'] = $hasCustomRouting;

        return $self;
    }

    /**
     * The applied subscription status. Echoes the requested value, so it is always OPTED_IN or OPTED_OUT.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
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
}
