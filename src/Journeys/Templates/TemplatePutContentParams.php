<?php

declare(strict_types=1);

namespace Courier\Journeys\Templates;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Journeys\Templates\TemplatePutContentParams\Content;
use Courier\Notifications\NotificationTemplateState;

/**
 * Replace the elemental content of a journey-scoped notification template. Overwrites all elements in the template draft with the provided content.
 *
 * @see Courier\Services\Journeys\TemplatesService::putContent()
 *
 * @phpstan-import-type ContentShape from \Courier\Journeys\Templates\TemplatePutContentParams\Content
 *
 * @phpstan-type TemplatePutContentParamsShape = array{
 *   templateID: string,
 *   content: Content|ContentShape,
 *   state?: null|NotificationTemplateState|value-of<NotificationTemplateState>,
 * }
 */
final class TemplatePutContentParams implements BaseModel
{
    /** @use SdkModel<TemplatePutContentParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $templateID;

    /**
     * Elemental content payload. The server defaults `version` when omitted.
     */
    #[Required]
    public Content $content;

    /**
     * Template state. Defaults to `DRAFT`.
     *
     * @var value-of<NotificationTemplateState>|null $state
     */
    #[Optional(enum: NotificationTemplateState::class)]
    public ?string $state;

    /**
     * `new TemplatePutContentParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TemplatePutContentParams::with(templateID: ..., content: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TemplatePutContentParams)->withTemplateID(...)->withContent(...)
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
     * @param Content|ContentShape $content
     * @param NotificationTemplateState|value-of<NotificationTemplateState>|null $state
     */
    public static function with(
        string $templateID,
        Content|array $content,
        NotificationTemplateState|string|null $state = null,
    ): self {
        $self = new self;

        $self['templateID'] = $templateID;
        $self['content'] = $content;

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
     * Elemental content payload. The server defaults `version` when omitted.
     *
     * @param Content|ContentShape $content
     */
    public function withContent(Content|array $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

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
