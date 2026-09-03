<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\NotificationTemplateUpdateRequest\State;

/**
 * Request body for replacing a notification template. All fields are required, since `PUT` is a full replacement, except `alias`, whose omission leaves the existing aliases in place. Unlike `NotificationTemplateCreateRequest`, `notification.content` is not required to place its elements inside a channel block: the requirement applies to creation only, so templates already stored without one stay editable.
 *
 * @phpstan-import-type NotificationTemplateWritePayloadShape from \Courier\Notifications\NotificationTemplateWritePayload
 *
 * @phpstan-type NotificationTemplateUpdateRequestShape = array{
 *   notification: NotificationTemplateWritePayload|NotificationTemplateWritePayloadShape,
 *   state?: null|State|value-of<State>,
 * }
 */
final class NotificationTemplateUpdateRequest implements BaseModel
{
    /** @use SdkModel<NotificationTemplateUpdateRequestShape> */
    use SdkModel;

    /**
     * Template fields accepted in POST and PUT request bodies, nested under a `notification` key.
     */
    #[Required]
    public NotificationTemplateWritePayload $notification;

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
     * @param NotificationTemplateWritePayload|NotificationTemplateWritePayloadShape $notification
     * @param State|value-of<State>|null $state
     */
    public static function with(
        NotificationTemplateWritePayload|array $notification,
        State|string|null $state = null,
    ): self {
        $self = new self;

        $self['notification'] = $notification;

        null !== $state && $self['state'] = $state;

        return $self;
    }

    /**
     * Template fields accepted in POST and PUT request bodies, nested under a `notification` key.
     *
     * @param NotificationTemplateWritePayload|NotificationTemplateWritePayloadShape $notification
     */
    public function withNotification(
        NotificationTemplateWritePayload|array $notification
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
