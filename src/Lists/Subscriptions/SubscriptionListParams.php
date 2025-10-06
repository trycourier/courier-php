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
 * $params = (new SubscriptionListParams); // set properties as needed
 * $client->lists.subscriptions->list(...$params->toArray());
 * ```
 * Get the list's subscriptions.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->lists.subscriptions->list(...$params->toArray());`
 *
 * @see Courier\Lists\Subscriptions->list
 *
 * @phpstan-type subscription_list_params = array{cursor?: string|null}
 */
final class SubscriptionListParams implements BaseModel
{
    /** @use SdkModel<subscription_list_params> */
    use SdkModel;
    use SdkParams;

    /**
     * A unique identifier that allows for fetching the next set of list subscriptions.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $cursor;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $cursor = null): self
    {
        $obj = new self;

        null !== $cursor && $obj->cursor = $cursor;

        return $obj;
    }

    /**
     * A unique identifier that allows for fetching the next set of list subscriptions.
     */
    public function withCursor(?string $cursor): self
    {
        $obj = clone $this;
        $obj->cursor = $cursor;

        return $obj;
    }
}
