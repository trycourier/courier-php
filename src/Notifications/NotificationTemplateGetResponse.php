<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\NotificationTemplateGetResponse\Notification;
use Courier\Notifications\NotificationTemplateGetResponse\State;

/**
 * Envelope response for GET /notifications/{id}. The notification object mirrors the POST/PUT input shape. Nullable fields return null when unset.
 *
 * @phpstan-import-type NotificationShape from \Courier\Notifications\NotificationTemplateGetResponse\Notification
 *
 * @phpstan-type NotificationTemplateGetResponseShape = array{
 *   created: int,
 *   creator: string,
 *   notification: Notification|NotificationShape,
 *   state: State|value-of<State>,
 *   updated?: int|null,
 *   updater?: string|null,
 * }
 */
final class NotificationTemplateGetResponse implements BaseModel
{
    /** @use SdkModel<NotificationTemplateGetResponseShape> */
    use SdkModel;

    /**
     * Epoch milliseconds when the template was created.
     */
    #[Required]
    public int $created;

    /**
     * User ID of the creator.
     */
    #[Required]
    public string $creator;

    /**
     * Full document shape used in POST and PUT request bodies, and returned inside the GET response envelope.
     */
    #[Required]
    public Notification $notification;

    /**
     * The template state. Always uppercase.
     *
     * @var value-of<State> $state
     */
    #[Required(enum: State::class)]
    public string $state;

    /**
     * Epoch milliseconds of last update.
     */
    #[Optional]
    public ?int $updated;

    /**
     * User ID of the last updater.
     */
    #[Optional]
    public ?string $updater;

    /**
     * `new NotificationTemplateGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationTemplateGetResponse::with(
     *   created: ..., creator: ..., notification: ..., state: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationTemplateGetResponse)
     *   ->withCreated(...)
     *   ->withCreator(...)
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
        int $created,
        string $creator,
        Notification|array $notification,
        State|string $state,
        ?int $updated = null,
        ?string $updater = null,
    ): self {
        $self = new self;

        $self['created'] = $created;
        $self['creator'] = $creator;
        $self['notification'] = $notification;
        $self['state'] = $state;

        null !== $updated && $self['updated'] = $updated;
        null !== $updater && $self['updater'] = $updater;

        return $self;
    }

    /**
     * Epoch milliseconds when the template was created.
     */
    public function withCreated(int $created): self
    {
        $self = clone $this;
        $self['created'] = $created;

        return $self;
    }

    /**
     * User ID of the creator.
     */
    public function withCreator(string $creator): self
    {
        $self = clone $this;
        $self['creator'] = $creator;

        return $self;
    }

    /**
     * Full document shape used in POST and PUT request bodies, and returned inside the GET response envelope.
     *
     * @param Notification|NotificationShape $notification
     */
    public function withNotification(Notification|array $notification): self
    {
        $self = clone $this;
        $self['notification'] = $notification;

        return $self;
    }

    /**
     * The template state. Always uppercase.
     *
     * @param State|value-of<State> $state
     */
    public function withState(State|string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }

    /**
     * Epoch milliseconds of last update.
     */
    public function withUpdated(int $updated): self
    {
        $self = clone $this;
        $self['updated'] = $updated;

        return $self;
    }

    /**
     * User ID of the last updater.
     */
    public function withUpdater(string $updater): self
    {
        $self = clone $this;
        $self['updater'] = $updater;

        return $self;
    }
}
