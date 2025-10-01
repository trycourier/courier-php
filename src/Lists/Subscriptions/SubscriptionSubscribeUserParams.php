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
 * $params = (new SubscriptionSubscribeUserParams); // set properties as needed
 * $client->lists.subscriptions->subscribeUser(...$params->toArray());
 * ```
 * Subscribe a user to an existing list (note: if the List does not exist, it will be automatically created).
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->lists.subscriptions->subscribeUser(...$params->toArray());`
 *
 * @see Courier\Lists\Subscriptions->subscribeUser
 *
 * @phpstan-type subscription_subscribe_user_params = array{
 *   listID: string, preferences?: RecipientPreferences|null
 * }
 */
final class SubscriptionSubscribeUserParams implements BaseModel
{
    /** @use SdkModel<subscription_subscribe_user_params> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $listID;

    #[Api(nullable: true, optional: true)]
    public ?RecipientPreferences $preferences;

    /**
     * `new SubscriptionSubscribeUserParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionSubscribeUserParams::with(listID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionSubscribeUserParams)->withListID(...)
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
    public static function with(
        string $listID,
        ?RecipientPreferences $preferences = null
    ): self {
        $obj = new self;

        $obj->listID = $listID;

        null !== $preferences && $obj->preferences = $preferences;

        return $obj;
    }

    public function withListID(string $listID): self
    {
        $obj = clone $this;
        $obj->listID = $listID;

        return $obj;
    }

    public function withPreferences(?RecipientPreferences $preferences): self
    {
        $obj = clone $this;
        $obj->preferences = $preferences;

        return $obj;
    }
}
