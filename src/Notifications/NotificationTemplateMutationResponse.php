<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\NotificationTemplateMutationResponse\Notification;
use Courier\Notifications\NotificationTemplateMutationResponse\State;

/**
 * Response returned by POST and PUT operations.
 *
 * @phpstan-import-type NotificationShape from \Courier\Notifications\NotificationTemplateMutationResponse\Notification
 *
 * @phpstan-type NotificationTemplateMutationResponseShape = array{
 *   notification: Notification|NotificationShape, state: State|value-of<State>
 * }
 */
final class NotificationTemplateMutationResponse implements BaseModel
{
    /** @use SdkModel<NotificationTemplateMutationResponseShape> */
    use SdkModel;

    #[Required]
    public Notification $notification;

    /**
     * The template state after the operation. Always uppercase.
     *
     * @var value-of<State> $state
     */
    #[Required(enum: State::class)]
    public string $state;

    /**
     * `new NotificationTemplateMutationResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationTemplateMutationResponse::with(notification: ..., state: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationTemplateMutationResponse)
     *   ->withNotification(...)
     *   ->withState(...)
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
     * @param State|value-of<State> $state
     */
    public static function with(
        Notification|array $notification,
        State|string $state
    ): self {
        $self = new self;

        $self['notification'] = $notification;
        $self['state'] = $state;

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

    /**
     * The template state after the operation. Always uppercase.
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
