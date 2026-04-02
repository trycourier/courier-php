<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\NotificationTemplateUpdateRequest\State;

/**
 * Request body for replacing a notification template. Same shape as create. All fields required (PUT = full replacement).
 *
 * @phpstan-import-type NotificationTemplatePayloadShape from \Courier\Notifications\NotificationTemplatePayload
 *
 * @phpstan-type NotificationTemplateUpdateRequestShape = array{
 *   notification: NotificationTemplatePayload|NotificationTemplatePayloadShape,
 *   state?: null|State|value-of<State>,
 * }
 */
final class NotificationTemplateUpdateRequest implements BaseModel
{
    /** @use SdkModel<NotificationTemplateUpdateRequestShape> */
    use SdkModel;

    /**
     * Full document shape used in POST and PUT request bodies, and returned inside the GET response envelope.
     */
    #[Required]
    public NotificationTemplatePayload $notification;

    /**
     * Template state after update. Case-insensitive input, normalized to uppercase in the response. Defaults to "DRAFT".
     *
     * @var value-of<State>|null $state
     */
    #[Optional(enum: State::class)]
    public ?string $state;

    /**
     * `new NotificationTemplateUpdateRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationTemplateUpdateRequest::with(notification: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationTemplateUpdateRequest)->withNotification(...)
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
     * @param NotificationTemplatePayload|NotificationTemplatePayloadShape $notification
     * @param State|value-of<State>|null $state
     */
    public static function with(
        NotificationTemplatePayload|array $notification,
        State|string|null $state = null
    ): self {
        $self = new self;

        $self['notification'] = $notification;

        null !== $state && $self['state'] = $state;

        return $self;
    }

    /**
     * Full document shape used in POST and PUT request bodies, and returned inside the GET response envelope.
     *
     * @param NotificationTemplatePayload|NotificationTemplatePayloadShape $notification
     */
    public function withNotification(
        NotificationTemplatePayload|array $notification
    ): self {
        $self = clone $this;
        $self['notification'] = $notification;

        return $self;
    }

    /**
     * Template state after update. Case-insensitive input, normalized to uppercase in the response. Defaults to "DRAFT".
     *
     * @param State|value-of<State> $state
     */
    public function withState(State|string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }
}
