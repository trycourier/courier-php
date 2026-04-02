<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationTemplatePayload;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Subscription topic reference, or null for none.
 *
 * @phpstan-type SubscriptionShape = array{topicID: string}
 */
final class Subscription implements BaseModel
{
    /** @use SdkModel<SubscriptionShape> */
    use SdkModel;

    #[Required('topic_id')]
    public string $topicID;

    /**
     * `new Subscription()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Subscription::with(topicID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Subscription)->withTopicID(...)
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
    public static function with(string $topicID): self
    {
        $self = new self;

        $self['topicID'] = $topicID;

        return $self;
    }

    public function withTopicID(string $topicID): self
    {
        $self = clone $this;
        $self['topicID'] = $topicID;

        return $self;
    }
}
