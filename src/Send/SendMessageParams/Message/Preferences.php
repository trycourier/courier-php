<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams\Message;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type PreferencesShape = array{subscription_topic_id: string}
 */
final class Preferences implements BaseModel
{
    /** @use SdkModel<PreferencesShape> */
    use SdkModel;

    /**
     * The subscription topic to apply to the message.
     */
    #[Required]
    public string $subscription_topic_id;

    /**
     * `new Preferences()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Preferences::with(subscription_topic_id: ...)
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
    public static function with(string $subscription_topic_id): self
    {
        $obj = new self;

        $obj['subscription_topic_id'] = $subscription_topic_id;

        return $obj;
    }

    /**
     * The subscription topic to apply to the message.
     */
    public function withSubscriptionTopicID(string $subscriptionTopicID): self
    {
        $obj = clone $this;
        $obj['subscription_topic_id'] = $subscriptionTopicID;

        return $obj;
    }
}
