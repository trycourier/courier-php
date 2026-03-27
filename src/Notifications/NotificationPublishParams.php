<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Publish a notification template. Publishes the current draft by default. Pass a version in the request body to publish a specific historical version.
 *
 * @see Courier\Services\NotificationsService::publish()
 *
 * @phpstan-type NotificationPublishParamsShape = array{version?: string|null}
 */
final class NotificationPublishParams implements BaseModel
{
    /** @use SdkModel<NotificationPublishParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Historical version to publish (e.g. "v001"). Omit to publish the current draft.
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
     * Historical version to publish (e.g. "v001"). Omit to publish the current draft.
     */
    public function withVersion(string $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }
}
