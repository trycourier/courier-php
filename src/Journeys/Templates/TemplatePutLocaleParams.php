<?php

declare(strict_types=1);

namespace Courier\Journeys\Templates;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Journeys\Templates\TemplatePutLocaleParams\Element;
use Courier\Notifications\NotificationTemplateState;

/**
 * Set locale-specific content overrides for a journey-scoped notification template. Each element override must reference an existing element by ID.
 *
 * @see Courier\Services\Journeys\TemplatesService::putLocale()
 *
 * @phpstan-import-type ElementShape from \Courier\Journeys\Templates\TemplatePutLocaleParams\Element
 *
 * @phpstan-type TemplatePutLocaleParamsShape = array{
 *   templateID: string,
 *   notificationID: string,
 *   elements: list<Element|ElementShape>,
 *   state?: null|NotificationTemplateState|value-of<NotificationTemplateState>,
 * }
 */
final class TemplatePutLocaleParams implements BaseModel
{
    /** @use SdkModel<TemplatePutLocaleParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $templateID;

    #[Required]
    public string $notificationID;

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
     * `new TemplatePutLocaleParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TemplatePutLocaleParams::with(
     *   templateID: ..., notificationID: ..., elements: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TemplatePutLocaleParams)
     *   ->withTemplateID(...)
     *   ->withNotificationID(...)
     *   ->withElements(...)
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
        string $templateID,
        string $notificationID,
        array $elements,
        NotificationTemplateState|string|null $state = null,
    ): self {
        $self = new self;

        $self['templateID'] = $templateID;
        $self['notificationID'] = $notificationID;
        $self['elements'] = $elements;

        null !== $state && $self['state'] = $state;

        return $self;
    }

    public function withTemplateID(string $templateID): self
    {
        $self = clone $this;
        $self['templateID'] = $templateID;

        return $self;
    }

    public function withNotificationID(string $notificationID): self
    {
        $self = clone $this;
        $self['notificationID'] = $notificationID;

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
