<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams\Message;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type PreferencesShape = array{subscriptionTopicID: string}
 */
final class Preferences implements BaseModel
{
    /** @use SdkModel<PreferencesShape> */
    use SdkModel;

    /**
     * The subscription topic to apply to the message.
     */
    #[Required('subscription_topic_id')]
    public string $subscriptionTopicID;

    /**
     * `new Preferences()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Preferences::with(subscriptionTopicID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Preferences)->withSubscriptionTopicID(...)
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
    public static function with(string $subscriptionTopicID): self
    {
        $self = new self;

        $self['subscriptionTopicID'] = $subscriptionTopicID;

        return $self;
    }

    /**
     * The subscription topic to apply to the message.
     */
    public function withSubscriptionTopicID(string $subscriptionTopicID): self
    {
        $self = clone $this;
        $self['subscriptionTopicID'] = $subscriptionTopicID;

        return $self;
    }
}
