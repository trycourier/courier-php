<?php

declare(strict_types=1);

namespace Courier\Bulk;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\MapOf;
use Courier\ElementalContent;
use Courier\ElementalContentSugar;

/**
 * Bulk message definition. Supports two formats:
 * - V1 format: Requires `event` field (event ID or notification ID)
 * - V2 format: Optionally use `template` (notification ID) or `content` (Elemental content) in addition to `event`
 *
 * @phpstan-import-type ContentVariants from \Courier\Bulk\InboundBulkMessage\Content
 * @phpstan-import-type ContentShape from \Courier\Bulk\InboundBulkMessage\Content
 *
 * @phpstan-type InboundBulkMessageShape = array{
 *   event: string,
 *   brand?: string|null,
 *   content?: ContentShape|null,
 *   data?: array<string,mixed>|null,
 *   locale?: array<string,array<string,mixed>>|null,
 *   override?: array<string,mixed>|null,
 *   template?: string|null,
 * }
 */
final class InboundBulkMessage implements BaseModel
{
    /** @use SdkModel<InboundBulkMessageShape> */
    use SdkModel;

    /**
     * Event ID or Notification ID (required). Can be either a
     * Notification ID (e.g., "FRH3QXM9E34W4RKP7MRC8NZ1T8V8") or a custom Event ID
     * (e.g., "welcome-email") mapped to a notification.
     */
    #[Required]
    public string $event;

    #[Optional(nullable: true)]
    public ?string $brand;

    /**
     * Elemental content (optional, for V2 format). When provided, this will be used
     * instead of the notification associated with the `event` field.
     *
     * @var ContentVariants|null $content
     */
    #[Optional(nullable: true)]
    public ElementalContentSugar|ElementalContent|null $content;

    /** @var array<string,mixed>|null $data */
    #[Optional(map: 'mixed', nullable: true)]
    public ?array $data;

    /** @var array<string,array<string,mixed>>|null $locale */
    #[Optional(map: new MapOf('mixed'), nullable: true)]
    public ?array $locale;

    /** @var array<string,mixed>|null $override */
    #[Optional(map: 'mixed', nullable: true)]
    public ?array $override;

    /**
     * Notification ID or template ID (optional, for V2 format). When provided,
     * this will be used instead of the notification associated with the `event` field.
     */
    #[Optional(nullable: true)]
    public ?string $template;

    /**
     * `new InboundBulkMessage()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundBulkMessage::with(event: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundBulkMessage)->withEvent(...)
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
     * @param ContentShape|null $content
     * @param array<string,mixed>|null $data
     * @param array<string,array<string,mixed>>|null $locale
     * @param array<string,mixed>|null $override
     */
    public static function with(
        string $event,
        ?string $brand = null,
        ElementalContentSugar|array|ElementalContent|null $content = null,
        ?array $data = null,
        ?array $locale = null,
        ?array $override = null,
        ?string $template = null,
    ): self {
        $self = new self;

        $self['event'] = $event;

        null !== $brand && $self['brand'] = $brand;
        null !== $content && $self['content'] = $content;
        null !== $data && $self['data'] = $data;
        null !== $locale && $self['locale'] = $locale;
        null !== $override && $self['override'] = $override;
        null !== $template && $self['template'] = $template;

        return $self;
    }

    /**
     * Event ID or Notification ID (required). Can be either a
     * Notification ID (e.g., "FRH3QXM9E34W4RKP7MRC8NZ1T8V8") or a custom Event ID
     * (e.g., "welcome-email") mapped to a notification.
     */
    public function withEvent(string $event): self
    {
        $self = clone $this;
        $self['event'] = $event;

        return $self;
    }

    public function withBrand(?string $brand): self
    {
        $self = clone $this;
        $self['brand'] = $brand;

        return $self;
    }

    /**
     * Elemental content (optional, for V2 format). When provided, this will be used
     * instead of the notification associated with the `event` field.
     *
     * @param ContentShape|null $content
     */
    public function withContent(
        ElementalContentSugar|array|ElementalContent|null $content
    ): self {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }

    /**
     * @param array<string,mixed>|null $data
     */
    public function withData(?array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * @param array<string,array<string,mixed>>|null $locale
     */
    public function withLocale(?array $locale): self
    {
        $self = clone $this;
        $self['locale'] = $locale;

        return $self;
    }

    /**
     * @param array<string,mixed>|null $override
     */
    public function withOverride(?array $override): self
    {
        $self = clone $this;
        $self['override'] = $override;

        return $self;
    }

    /**
     * Notification ID or template ID (optional, for V2 format). When provided,
     * this will be used instead of the notification associated with the `event` field.
     */
    public function withTemplate(?string $template): self
    {
        $self = clone $this;
        $self['template'] = $template;

        return $self;
    }
}
