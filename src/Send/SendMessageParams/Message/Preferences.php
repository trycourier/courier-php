<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams\Message;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type preferences_alias = array{subscriptionTopicID: string}
 */
final class Preferences implements BaseModel
{
    /** @use SdkModel<preferences_alias> */
    use SdkModel;

    /**
     * The subscription topic to apply to the message.
     */
    #[Api('subscription_topic_id')]
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
        $obj = new self;

        $obj->subscriptionTopicID = $subscriptionTopicID;

        return $obj;
    }

    /**
     * The subscription topic to apply to the message.
     */
    public function withSubscriptionTopicID(string $subscriptionTopicID): self
    {
        $obj = clone $this;
        $obj->subscriptionTopicID = $subscriptionTopicID;

        return $obj;
    }
}
