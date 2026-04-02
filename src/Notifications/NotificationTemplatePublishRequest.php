<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Optional request body for publishing a notification template. Omit or send an empty object to publish the current draft.
 *
 * @phpstan-type NotificationTemplatePublishRequestShape = array{
 *   version?: string|null
 * }
 */
final class NotificationTemplatePublishRequest implements BaseModel
{
    /** @use SdkModel<NotificationTemplatePublishRequestShape> */
    use SdkModel;

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
