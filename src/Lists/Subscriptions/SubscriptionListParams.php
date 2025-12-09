<?php

declare(strict_types=1);

namespace Courier\Lists\Subscriptions;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Get the list's subscriptions.
 *
 * @see Courier\Services\Lists\SubscriptionsService::list()
 *
 * @phpstan-type SubscriptionListParamsShape = array{cursor?: string|null}
 */
final class SubscriptionListParams implements BaseModel
{
    /** @use SdkModel<SubscriptionListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * A unique identifier that allows for fetching the next set of list subscriptions.
     */
    #[Optional(nullable: true)]
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
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * A unique identifier that allows for fetching the next set of list subscriptions.
     */
    public function withCursor(?string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }
}
