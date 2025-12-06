<?php

declare(strict_types=1);

namespace Courier\Lists\Subscriptions;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Delete a subscription to a list by list ID and user ID.
 *
 * @see Courier\Services\Lists\SubscriptionsService::unsubscribeUser()
 *
 * @phpstan-type SubscriptionUnsubscribeUserParamsShape = array{list_id: string}
 */
final class SubscriptionUnsubscribeUserParams implements BaseModel
{
    /** @use SdkModel<SubscriptionUnsubscribeUserParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $list_id;

    /**
     * `new SubscriptionUnsubscribeUserParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionUnsubscribeUserParams::with(list_id: ...)
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
    public static function with(string $list_id): self
    {
        $obj = new self;

        $obj['list_id'] = $list_id;

        return $obj;
    }

    public function withListID(string $listID): self
    {
        $obj = clone $this;
        $obj['list_id'] = $listID;

        return $obj;
    }
}
