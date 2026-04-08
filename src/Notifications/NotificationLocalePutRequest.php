<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\NotificationLocalePutRequest\Element;

/**
 * Request body for setting locale-specific content overrides. Each element override must include the target element ID.
 *
 * @phpstan-import-type ElementShape from \Courier\Notifications\NotificationLocalePutRequest\Element
 *
 * @phpstan-type NotificationLocalePutRequestShape = array{
 *   elements: list<Element|ElementShape>,
 *   state?: null|NotificationTemplateState|value-of<NotificationTemplateState>,
 * }
 */
final class NotificationLocalePutRequest implements BaseModel
{
    /** @use SdkModel<NotificationLocalePutRequestShape> */
    use SdkModel;

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
     * `new NotificationLocalePutRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationLocalePutRequest::with(elements: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationLocalePutRequest)->withElements(...)
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
        array $elements,
        NotificationTemplateState|string|null $state = null
    ): self {
        $self = new self;

        $self['elements'] = $elements;

        null !== $state && $self['state'] = $state;

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
