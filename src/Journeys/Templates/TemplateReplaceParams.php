<?php

declare(strict_types=1);

namespace Courier\Journeys\Templates;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Journeys\Templates\TemplateReplaceParams\Notification;

/**
 * Replace the journey-scoped notification template draft.
 *
 * @see Courier\Services\Journeys\TemplatesService::replace()
 *
 * @phpstan-import-type NotificationShape from \Courier\Journeys\Templates\TemplateReplaceParams\Notification
 *
 * @phpstan-type TemplateReplaceParamsShape = array{
 *   templateID: string,
 *   notification: Notification|NotificationShape,
 *   state?: string|null,
 * }
 */
final class TemplateReplaceParams implements BaseModel
{
    /** @use SdkModel<TemplateReplaceParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $templateID;

    #[Required]
    public Notification $notification;

    #[Optional]
    public ?string $state;

    /**
     * `new TemplateReplaceParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TemplateReplaceParams::with(templateID: ..., notification: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TemplateReplaceParams)->withTemplateID(...)->withNotification(...)
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
        string $templateID,
        Notification|array $notification,
        ?string $state = null
    ): self {
        $self = new self;

        $self['templateID'] = $templateID;
        $self['notification'] = $notification;

        null !== $state && $self['state'] = $state;

        return $self;
    }

    public function withTemplateID(string $templateID): self
    {
        $self = clone $this;
        $self['templateID'] = $templateID;

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
