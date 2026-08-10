<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\NotificationReplaceParams\State;

/**
 * Replaces a notification template in full, so send every field rather than only the ones you want changed. Publish separately to make it live.
 *
 * @see Courier\Services\NotificationsService::replace()
 *
 * @phpstan-import-type NotificationTemplateWritePayloadShape from \Courier\Notifications\NotificationTemplateWritePayload
 *
 * @phpstan-type NotificationReplaceParamsShape = array{
 *   notification: NotificationTemplateWritePayload|NotificationTemplateWritePayloadShape,
 *   state?: null|State|value-of<State>,
 * }
 */
final class NotificationReplaceParams implements BaseModel
{
    /** @use SdkModel<NotificationReplaceParamsShape> */
    use SdkModel;
    use SdkParams;

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
     * `new NotificationReplaceParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationReplaceParams::with(notification: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationReplaceParams)->withNotification(...)
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
