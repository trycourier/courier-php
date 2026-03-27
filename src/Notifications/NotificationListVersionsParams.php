<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * List versions of a notification template.
 *
 * @see Courier\Services\NotificationsService::listVersions()
 *
 * @phpstan-type NotificationListVersionsParamsShape = array{
 *   cursor?: string|null, limit?: int|null
 * }
 */
final class NotificationListVersionsParams implements BaseModel
{
    /** @use SdkModel<NotificationListVersionsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Opaque pagination cursor from a previous response. Omit for the first page.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Maximum number of versions to return per page. Default 10, max 10.
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
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * Maximum number of versions to return per page. Default 10, max 10.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }
}
