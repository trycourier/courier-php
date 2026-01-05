<?php

declare(strict_types=1);

namespace Courier\Lists\Subscriptions;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Delete a subscription to a list by list ID and user ID.
 *
 * @see Courier\Services\Lists\SubscriptionsService::unsubscribeUser()
 *
 * @phpstan-type SubscriptionUnsubscribeUserParamsShape = array{listID: string}
 */
final class SubscriptionUnsubscribeUserParams implements BaseModel
{
    /** @use SdkModel<SubscriptionUnsubscribeUserParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
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
        $self = new self;

        $self['listID'] = $listID;

        return $self;
    }

    public function withListID(string $listID): self
    {
        $self = clone $this;
        $self['listID'] = $listID;

        return $self;
    }
}
