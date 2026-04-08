<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\NotificationPutContentParams\Content;

/**
 * Replace the elemental content of a notification template. Overwrites all elements in the template with the provided content. Only supported for V2 (elemental) templates.
 *
 * @see Courier\Services\NotificationsService::putContent()
 *
 * @phpstan-import-type ContentShape from \Courier\Notifications\NotificationPutContentParams\Content
 *
 * @phpstan-type NotificationPutContentParamsShape = array{
 *   content: Content|ContentShape,
 *   state?: null|NotificationTemplateState|value-of<NotificationTemplateState>,
 * }
 */
final class NotificationPutContentParams implements BaseModel
{
    /** @use SdkModel<NotificationPutContentParamsShape> */
    use SdkModel;
    use SdkParams;

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
     * `new NotificationPutContentParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationPutContentParams::with(content: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationPutContentParams)->withContent(...)
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
        Content|array $content,
        NotificationTemplateState|string|null $state = null
    ): self {
        $self = new self;

        $self['content'] = $content;

        null !== $state && $self['state'] = $state;

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
