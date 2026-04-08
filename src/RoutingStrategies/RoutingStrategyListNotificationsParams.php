<?php

declare(strict_types=1);

namespace Courier\RoutingStrategies;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * List notification templates associated with a routing strategy. Includes template metadata only, not full content.
 *
 * @see Courier\Services\RoutingStrategiesService::listNotifications()
 *
 * @phpstan-type RoutingStrategyListNotificationsParamsShape = array{
 *   cursor?: string|null, limit?: int|null
 * }
 */
final class RoutingStrategyListNotificationsParams implements BaseModel
{
    /** @use SdkModel<RoutingStrategyListNotificationsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Opaque pagination cursor from a previous response. Omit for the first page.
     */
    #[Optional(nullable: true)]
    public ?string $cursor;

    /**
     * Maximum number of results per page. Default 20, max 100.
     */
    #[Optional]
    public ?int $limit;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $cursor = null, ?int $limit = null): self
    {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;

        return $self;
    }

    /**
     * Opaque pagination cursor from a previous response. Omit for the first page.
     */
    public function withCursor(?string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * Maximum number of results per page. Default 20, max 100.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }
}
