<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Retrieve a notification template by ID. Returns the published version by default. Pass version=draft to retrieve an unpublished template.
 *
 * @see Courier\Services\NotificationsService::retrieve()
 *
 * @phpstan-type NotificationRetrieveParamsShape = array{version?: string|null}
 */
final class NotificationRetrieveParams implements BaseModel
{
    /** @use SdkModel<NotificationRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Version to retrieve. One of "draft", "published", or a version string like "v001". Defaults to "published".
     */
    #[Optional]
    public ?string $version;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $version = null): self
    {
        $self = new self;

        null !== $version && $self['version'] = $version;

        return $self;
    }

    /**
     * Version to retrieve. One of "draft", "published", or a version string like "v001". Defaults to "published".
     */
    public function withVersion(string $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }
}
