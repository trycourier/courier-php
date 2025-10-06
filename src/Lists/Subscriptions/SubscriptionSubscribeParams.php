<?php

declare(strict_types=1);

namespace Courier\Lists\Subscriptions;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new SubscriptionSubscribeParams); // set properties as needed
 * $client->lists.subscriptions->subscribe(...$params->toArray());
 * ```
 * Subscribes the users to the list, overwriting existing subscriptions. If the list does not exist, it will be automatically created.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->lists.subscriptions->subscribe(...$params->toArray());`
 *
 * @see Courier\Lists\Subscriptions->subscribe
 *
 * @phpstan-type subscription_subscribe_params = array{
 *   recipients: list<PutSubscriptionsRecipient>
 * }
 */
final class SubscriptionSubscribeParams implements BaseModel
{
    /** @use SdkModel<subscription_subscribe_params> */
    use SdkModel;
    use SdkParams;

    /** @var list<PutSubscriptionsRecipient> $recipients */
    #[Api(list: PutSubscriptionsRecipient::class)]
    public array $recipients;

    /**
     * `new SubscriptionSubscribeParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionSubscribeParams::with(recipients: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionSubscribeParams)->withRecipients(...)
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
     * @param list<PutSubscriptionsRecipient> $recipients
     */
    public static function with(array $recipients): self
    {
        $obj = new self;

        $obj->recipients = $recipients;

        return $obj;
    }

    /**
     * @param list<PutSubscriptionsRecipient> $recipients
     */
    public function withRecipients(array $recipients): self
    {
        $obj = clone $this;
        $obj->recipients = $recipients;

        return $obj;
    }
}
