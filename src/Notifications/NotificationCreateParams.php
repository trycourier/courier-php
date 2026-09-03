<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\NotificationCreateParams\State;

/**
 * Create a notification template. Requires all fields in the notification object. Templates are created in draft state by default.
 *
 * Content must place its elements inside a channel block — `{ "type": "channel", "channel": "email", "elements": [...] }` — or the request returns `400`. The template designer renders only the channel block matching the tab it draws, so content stored without one cannot be opened. An empty `elements` array is accepted, and the requirement applies to creation only: `PUT /notifications/{id}` still accepts unwrapped content. Note this endpoint takes versioned content only — the `{ title, body }` shorthand accepted by `/send` is rejected here with an `invalid_request_error` on `notification.content.version`.
 *
 * @see Courier\Services\NotificationsService::create()
 *
 * @phpstan-import-type NotificationTemplateWritePayloadShape from \Courier\Notifications\NotificationTemplateWritePayload
 *
 * @phpstan-type NotificationCreateParamsShape = array{
 *   notification: NotificationTemplateWritePayload|NotificationTemplateWritePayloadShape,
 *   state?: null|State|value-of<State>,
 *   idempotencyKey?: string|null,
 *   xIdempotencyExpiration?: string|null,
 * }
 */
final class NotificationCreateParams implements BaseModel
{
    /** @use SdkModel<NotificationCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Template fields accepted in POST and PUT request bodies, nested under a `notification` key.
     */
    #[Required]
    public NotificationTemplateWritePayload $notification;

    /**
     * Template state after creation. Case-insensitive input, normalized to uppercase in the response. Defaults to "DRAFT".
     *
     * @var value-of<State>|null $state
     */
    #[Optional(enum: State::class)]
    public ?string $state;

    #[Optional]
    public ?string $idempotencyKey;

    #[Optional]
    public ?string $xIdempotencyExpiration;

    /**
     * `new NotificationCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationCreateParams::with(notification: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationCreateParams)->withNotification(...)
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
        ?string $idempotencyKey = null,
        ?string $xIdempotencyExpiration = null,
    ): self {
        $self = new self;

        $self['notification'] = $notification;

        null !== $state && $self['state'] = $state;
        null !== $idempotencyKey && $self['idempotencyKey'] = $idempotencyKey;
        null !== $xIdempotencyExpiration && $self['xIdempotencyExpiration'] = $xIdempotencyExpiration;

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
     * Template state after creation. Case-insensitive input, normalized to uppercase in the response. Defaults to "DRAFT".
     *
     * @param State|value-of<State> $state
     */
    public function withState(State|string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }

    public function withIdempotencyKey(string $idempotencyKey): self
    {
        $self = clone $this;
        $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }

    public function withXIdempotencyExpiration(
        string $xIdempotencyExpiration
    ): self {
        $self = clone $this;
        $self['xIdempotencyExpiration'] = $xIdempotencyExpiration;

        return $self;
    }
}
