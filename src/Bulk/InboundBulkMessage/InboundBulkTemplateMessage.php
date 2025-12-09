<?php

declare(strict_types=1);

namespace Courier\Bulk\InboundBulkMessage;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\MapOf;

/**
 * @phpstan-type InboundBulkTemplateMessageShape = array{
 *   template: string,
 *   brand?: string|null,
 *   data?: array<string,mixed>|null,
 *   event?: string|null,
 *   locale?: array<string,array<string,mixed>>|null,
 *   override?: array<string,mixed>|null,
 * }
 */
final class InboundBulkTemplateMessage implements BaseModel
{
    /** @use SdkModel<InboundBulkTemplateMessageShape> */
    use SdkModel;

    #[Required]
    public string $template;

    #[Optional(nullable: true)]
    public ?string $brand;

    /** @var array<string,mixed>|null $data */
    #[Optional(map: 'mixed', nullable: true)]
    public ?array $data;

    #[Optional(nullable: true)]
    public ?string $event;

    /** @var array<string,array<string,mixed>>|null $locale */
    #[Optional(map: new MapOf('mixed'), nullable: true)]
    public ?array $locale;

    /** @var array<string,mixed>|null $override */
    #[Optional(map: 'mixed', nullable: true)]
    public ?array $override;

    /**
     * `new InboundBulkTemplateMessage()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundBulkTemplateMessage::with(template: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundBulkTemplateMessage)->withTemplate(...)
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
     * @param array<string,mixed>|null $data
     * @param array<string,array<string,mixed>>|null $locale
     * @param array<string,mixed>|null $override
     */
    public static function with(
        string $template,
        ?string $brand = null,
        ?array $data = null,
        ?string $event = null,
        ?array $locale = null,
        ?array $override = null,
    ): self {
        $self = new self;

        $self['template'] = $template;

        null !== $brand && $self['brand'] = $brand;
        null !== $data && $self['data'] = $data;
        null !== $event && $self['event'] = $event;
        null !== $locale && $self['locale'] = $locale;
        null !== $override && $self['override'] = $override;

        return $self;
    }

    public function withTemplate(string $template): self
    {
        $self = clone $this;
        $self['template'] = $template;

        return $self;
    }

    public function withBrand(?string $brand): self
    {
        $self = clone $this;
        $self['brand'] = $brand;

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

    public function withEvent(?string $event): self
    {
        $self = clone $this;
        $self['event'] = $event;

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
}
