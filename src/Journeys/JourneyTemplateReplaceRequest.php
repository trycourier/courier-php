<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Journeys\JourneyTemplateReplaceRequest\Notification;

/**
 * @phpstan-import-type NotificationShape from \Courier\Journeys\JourneyTemplateReplaceRequest\Notification
 *
 * @phpstan-type JourneyTemplateReplaceRequestShape = array{
 *   notification: Notification|NotificationShape, state?: string|null
 * }
 */
final class JourneyTemplateReplaceRequest implements BaseModel
{
    /** @use SdkModel<JourneyTemplateReplaceRequestShape> */
    use SdkModel;

    #[Required]
    public Notification $notification;

    #[Optional]
    public ?string $state;

    /**
     * `new JourneyTemplateReplaceRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneyTemplateReplaceRequest::with(notification: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneyTemplateReplaceRequest)->withNotification(...)
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
     *
     * @param Notification|NotificationShape $notification
     */
    public static function with(
        Notification|array $notification,
        ?string $state = null
    ): self {
        $self = new self;

        $self['notification'] = $notification;

        null !== $state && $self['state'] = $state;

        return $self;
    }

    /**
     * @param Notification|NotificationShape $notification
     */
    public function withNotification(Notification|array $notification): self
    {
        $self = clone $this;
        $self['notification'] = $notification;

        return $self;
    }

    public function withState(string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }
}
