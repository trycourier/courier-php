<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Retrieve the content of a notification template. The response shape depends on whether the template uses V1 (blocks/channels) or V2 (elemental) content. Use the `version` query parameter to select draft, published, or a specific historical version.
 *
 * @see Courier\Services\NotificationsService::retrieveContent()
 *
 * @phpstan-type NotificationRetrieveContentParamsShape = array{
 *   version?: string|null
 * }
 */
final class NotificationRetrieveContentParams implements BaseModel
{
    /** @use SdkModel<NotificationRetrieveContentParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Accepts `draft`, `published`, or a version string (e.g., `v001`). Defaults to `published`.
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
     * Accepts `draft`, `published`, or a version string (e.g., `v001`). Defaults to `published`.
     */
    public function withVersion(string $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }
}
