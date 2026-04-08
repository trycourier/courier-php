<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Request body for updating a single element. Additional type-specific fields are allowed.
 *
 * @phpstan-type NotificationElementPutRequestShape = array{
 *   type: string,
 *   channels?: list<string>|null,
 *   data?: array<string,mixed>|null,
 *   if?: string|null,
 *   loop?: string|null,
 *   ref?: string|null,
 *   state?: null|NotificationTemplateState|value-of<NotificationTemplateState>,
 * }
 */
final class NotificationElementPutRequest implements BaseModel
{
    /** @use SdkModel<NotificationElementPutRequestShape> */
    use SdkModel;

    /**
     * Element type (text, meta, action, image, etc.).
     */
    #[Required]
    public string $type;

    /** @var list<string>|null $channels */
    #[Optional(list: 'string')]
    public ?array $channels;

    /** @var array<string,mixed>|null $data */
    #[Optional(map: 'mixed')]
    public ?array $data;

    #[Optional]
    public ?string $if;

    #[Optional]
    public ?string $loop;

    #[Optional]
    public ?string $ref;

    /**
     * Template state. Defaults to `DRAFT`.
     *
     * @var value-of<NotificationTemplateState>|null $state
     */
    #[Optional(enum: NotificationTemplateState::class)]
    public ?string $state;

    /**
     * `new NotificationElementPutRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationElementPutRequest::with(type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationElementPutRequest)->withType(...)
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
     * @param list<string>|null $channels
     * @param array<string,mixed>|null $data
     * @param NotificationTemplateState|value-of<NotificationTemplateState>|null $state
     */
    public static function with(
        string $type,
        ?array $channels = null,
        ?array $data = null,
        ?string $if = null,
        ?string $loop = null,
        ?string $ref = null,
        NotificationTemplateState|string|null $state = null,
    ): self {
        $self = new self;

        $self['type'] = $type;

        null !== $channels && $self['channels'] = $channels;
        null !== $data && $self['data'] = $data;
        null !== $if && $self['if'] = $if;
        null !== $loop && $self['loop'] = $loop;
        null !== $ref && $self['ref'] = $ref;
        null !== $state && $self['state'] = $state;

        return $self;
    }

    /**
     * Element type (text, meta, action, image, etc.).
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * @param list<string> $channels
     */
    public function withChannels(array $channels): self
    {
        $self = clone $this;
        $self['channels'] = $channels;

        return $self;
    }

    /**
     * @param array<string,mixed> $data
     */
    public function withData(array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    public function withIf(string $if): self
    {
        $self = clone $this;
        $self['if'] = $if;

        return $self;
    }

    public function withLoop(string $loop): self
    {
        $self = clone $this;
        $self['loop'] = $loop;

        return $self;
    }

    public function withRef(string $ref): self
    {
        $self = clone $this;
        $self['ref'] = $ref;

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
