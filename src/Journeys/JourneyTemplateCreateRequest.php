<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Journeys\JourneyTemplateCreateRequest\Notification;

/**
 * @phpstan-import-type NotificationShape from \Courier\Journeys\JourneyTemplateCreateRequest\Notification
 *
 * @phpstan-type JourneyTemplateCreateRequestShape = array{
 *   channel: string,
 *   notification: Notification|NotificationShape,
 *   providerKey?: string|null,
 *   state?: string|null,
 * }
 */
final class JourneyTemplateCreateRequest implements BaseModel
{
    /** @use SdkModel<JourneyTemplateCreateRequestShape> */
    use SdkModel;

    #[Required]
    public string $channel;

    #[Required]
    public Notification $notification;

    #[Optional]
    public ?string $providerKey;

    #[Optional]
    public ?string $state;

    /**
     * `new JourneyTemplateCreateRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneyTemplateCreateRequest::with(channel: ..., notification: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneyTemplateCreateRequest)->withChannel(...)->withNotification(...)
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
        string $channel,
        Notification|array $notification,
        ?string $providerKey = null,
        ?string $state = null,
    ): self {
        $self = new self;

        $self['channel'] = $channel;
        $self['notification'] = $notification;

        null !== $providerKey && $self['providerKey'] = $providerKey;
        null !== $state && $self['state'] = $state;

        return $self;
    }

    public function withChannel(string $channel): self
    {
        $self = clone $this;
        $self['channel'] = $channel;

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

    public function withProviderKey(string $providerKey): self
    {
        $self = clone $this;
        $self['providerKey'] = $providerKey;

        return $self;
    }

    public function withState(string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }
}
