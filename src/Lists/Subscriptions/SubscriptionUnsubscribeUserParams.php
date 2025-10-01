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
 * $params = (new SubscriptionUnsubscribeUserParams); // set properties as needed
 * $client->lists.subscriptions->unsubscribeUser(...$params->toArray());
 * ```
 * Delete a subscription to a list by list ID and user ID.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->lists.subscriptions->unsubscribeUser(...$params->toArray());`
 *
 * @see Courier\Lists\Subscriptions->unsubscribeUser
 *
 * @phpstan-type subscription_unsubscribe_user_params = array{listID: string}
 */
final class SubscriptionUnsubscribeUserParams implements BaseModel
{
    /** @use SdkModel<subscription_unsubscribe_user_params> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $listID;

    /**
     * `new SubscriptionUnsubscribeUserParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionUnsubscribeUserParams::with(listID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionUnsubscribeUserParams)->withListID(...)
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
    public static function with(string $listID): self
    {
        $obj = new self;

        $obj->listID = $listID;

        return $obj;
    }

    public function withListID(string $listID): self
    {
        $obj = clone $this;
        $obj->listID = $listID;

        return $obj;
    }
}
