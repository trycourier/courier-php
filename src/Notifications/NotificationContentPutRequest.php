<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\NotificationContentPutRequest\Content;

/**
 * Request body for replacing the elemental content of a notification template.
 *
 * @phpstan-import-type ContentShape from \Courier\Notifications\NotificationContentPutRequest\Content
 *
 * @phpstan-type NotificationContentPutRequestShape = array{
 *   content: Content|ContentShape,
 *   state?: null|NotificationTemplateState|value-of<NotificationTemplateState>,
 * }
 */
final class NotificationContentPutRequest implements BaseModel
{
    /** @use SdkModel<NotificationContentPutRequestShape> */
    use SdkModel;

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
     * `new NotificationContentPutRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationContentPutRequest::with(content: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationContentPutRequest)->withContent(...)
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
