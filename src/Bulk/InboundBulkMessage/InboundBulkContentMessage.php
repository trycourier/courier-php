<?php

declare(strict_types=1);

namespace Courier\Bulk\InboundBulkMessage;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\MapOf;
use Courier\ElementalContent;
use Courier\ElementalContentSugar;

/**
 * @phpstan-type InboundBulkContentMessageShape = array{
 *   content: ElementalContentSugar|ElementalContent,
 *   brand?: string|null,
 *   data?: array<string, mixed>|null,
 *   event?: string|null,
 *   locale?: array<string, array<string, mixed>>|null,
 *   override?: array<string, mixed>|null,
 * }
 */
final class InboundBulkContentMessage implements BaseModel
{
    /** @use SdkModel<InboundBulkContentMessageShape> */
    use SdkModel;

    /**
     * Syntactic sugar to provide a fast shorthand for Courier Elemental Blocks.
     */
    #[Api]
    public ElementalContentSugar|ElementalContent $content;

    #[Api(nullable: true, optional: true)]
    public ?string $brand;

    /** @var array<string, mixed>|null $data */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $data;

    #[Api(nullable: true, optional: true)]
    public ?string $event;

    /** @var array<string, array<string, mixed>>|null $locale */
    #[Api(map: new MapOf('mixed'), nullable: true, optional: true)]
    public ?array $locale;

    /** @var array<string, mixed>|null $override */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $override;

    /**
     * `new InboundBulkContentMessage()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundBulkContentMessage::with(content: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundBulkContentMessage)->withContent(...)
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
     * @param array<string, mixed>|null $data
     * @param array<string, array<string, mixed>>|null $locale
     * @param array<string, mixed>|null $override
     */
    public static function with(
        ElementalContentSugar|ElementalContent $content,
        ?string $brand = null,
        ?array $data = null,
        ?string $event = null,
        ?array $locale = null,
        ?array $override = null,
    ): self {
        $obj = new self;

        $obj->content = $content;

        null !== $brand && $obj->brand = $brand;
        null !== $data && $obj->data = $data;
        null !== $event && $obj->event = $event;
        null !== $locale && $obj->locale = $locale;
        null !== $override && $obj->override = $override;

        return $obj;
    }

    /**
     * Syntactic sugar to provide a fast shorthand for Courier Elemental Blocks.
     */
    public function withContent(
        ElementalContentSugar|ElementalContent $content
    ): self {
        $obj = clone $this;
        $obj->content = $content;

        return $obj;
    }

    public function withBrand(?string $brand): self
    {
        $obj = clone $this;
        $obj->brand = $brand;

        return $obj;
    }

    /**
     * @param array<string, mixed>|null $data
     */
    public function withData(?array $data): self
    {
        $obj = clone $this;
        $obj->data = $data;

        return $obj;
    }

    public function withEvent(?string $event): self
    {
        $obj = clone $this;
        $obj->event = $event;

        return $obj;
    }

    /**
     * @param array<string, array<string, mixed>>|null $locale
     */
    public function withLocale(?array $locale): self
    {
        $obj = clone $this;
        $obj->locale = $locale;

        return $obj;
    }

    /**
     * @param array<string, mixed>|null $override
     */
    public function withOverride(?array $override): self
    {
        $obj = clone $this;
        $obj->override = $override;

        return $obj;
    }
}
