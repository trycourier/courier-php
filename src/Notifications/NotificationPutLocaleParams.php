<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\NotificationPutLocaleParams\Element;

/**
 * Set locale-specific content overrides for a notification template. Each element override must reference an existing element by ID. Only supported for V2 (elemental) templates.
 *
 * @see Courier\Services\NotificationsService::putLocale()
 *
 * @phpstan-import-type ElementShape from \Courier\Notifications\NotificationPutLocaleParams\Element
 *
 * @phpstan-type NotificationPutLocaleParamsShape = array{
 *   id: string,
 *   elements: list<Element|ElementShape>,
 *   state?: null|NotificationTemplateState|value-of<NotificationTemplateState>,
 * }
 */
final class NotificationPutLocaleParams implements BaseModel
{
    /** @use SdkModel<NotificationPutLocaleParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * Elements with locale-specific content overrides.
     *
     * @var list<Element> $elements
     */
    #[Required(list: Element::class)]
    public array $elements;

    /**
     * Template state. Defaults to `DRAFT`.
     *
     * @var value-of<NotificationTemplateState>|null $state
     */
    #[Optional(enum: NotificationTemplateState::class)]
    public ?string $state;

    /**
     * `new NotificationPutLocaleParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationPutLocaleParams::with(id: ..., elements: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationPutLocaleParams)->withID(...)->withElements(...)
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
     * @param list<Element|ElementShape> $elements
     * @param NotificationTemplateState|value-of<NotificationTemplateState>|null $state
     */
    public static function with(
        string $id,
        array $elements,
        NotificationTemplateState|string|null $state = null
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['elements'] = $elements;

        null !== $state && $self['state'] = $state;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Elements with locale-specific content overrides.
     *
     * @param list<Element|ElementShape> $elements
     */
    public function withElements(array $elements): self
    {
        $self = clone $this;
        $self['elements'] = $elements;

        return $self;
    }

    /**
     * Template state. Defaults to `DRAFT`.
     *
     * @param NotificationTemplateState|value-of<NotificationTemplateState> $state
     */
    public function withState(NotificationTemplateState|string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }
}
