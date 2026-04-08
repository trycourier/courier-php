<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\NotificationContentMutationResponse\Element;

/**
 * Shared mutation response for `PUT` content, `PUT` element, and `PUT` locale operations. Contains the template ID, content version, per-element checksums, and resulting state.
 *
 * @phpstan-import-type ElementShape from \Courier\Notifications\NotificationContentMutationResponse\Element
 *
 * @phpstan-type NotificationContentMutationResponseShape = array{
 *   id: string,
 *   elements: list<Element|ElementShape>,
 *   state: NotificationTemplateState|value-of<NotificationTemplateState>,
 *   version: string,
 * }
 */
final class NotificationContentMutationResponse implements BaseModel
{
    /** @use SdkModel<NotificationContentMutationResponseShape> */
    use SdkModel;

    /**
     * Template ID.
     */
    #[Required]
    public string $id;

    /** @var list<Element> $elements */
    #[Required(list: Element::class)]
    public array $elements;

    /**
     * Template state. Defaults to `DRAFT`.
     *
     * @var value-of<NotificationTemplateState> $state
     */
    #[Required(enum: NotificationTemplateState::class)]
    public string $state;

    /**
     * Content version identifier.
     */
    #[Required]
    public string $version;

    /**
     * `new NotificationContentMutationResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationContentMutationResponse::with(
     *   id: ..., elements: ..., state: ..., version: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationContentMutationResponse)
     *   ->withID(...)
     *   ->withElements(...)
     *   ->withState(...)
     *   ->withVersion(...)
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
     * @param NotificationTemplateState|value-of<NotificationTemplateState> $state
     */
    public static function with(
        string $id,
        array $elements,
        string $version,
        NotificationTemplateState|string $state = 'DRAFT',
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['elements'] = $elements;
        $self['state'] = $state;
        $self['version'] = $version;

        return $self;
    }

    /**
     * Template ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
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

    /**
     * Content version identifier.
     */
    public function withVersion(string $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }
}
