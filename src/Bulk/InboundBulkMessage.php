<?php

declare(strict_types=1);

namespace Courier\Bulk;

use Courier\Bulk\InboundBulkMessage\Message\InboundBulkContentMessage;
use Courier\Bulk\InboundBulkMessage\Message\InboundBulkTemplateMessage;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type inbound_bulk_message = array{
 *   brand?: string|null,
 *   data?: array<string, mixed>|null,
 *   event?: string|null,
 *   locale?: array<string, mixed>|null,
 *   message?: null|inbound_bulk_template_message|inbound_bulk_content_message,
 *   override?: mixed,
 * }
 */
final class InboundBulkMessage implements BaseModel
{
    /** @use SdkModel<inbound_bulk_message> */
    use SdkModel;

    /**
     * A unique identifier that represents the brand that should be used
     * for rendering the notification.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $brand;

    /**
     * JSON that includes any data you want to pass to a message template.
     * The data will populate the corresponding template variables.
     *
     * @var array<string, mixed>|null $data
     */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $data;

    #[Api(nullable: true, optional: true)]
    public ?string $event;

    /** @var array<string, mixed>|null $locale */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $locale;

    /**
     * Describes the content of the message in a way that will
     * work for email, push, chat, or any channel.
     */
    #[Api(nullable: true, optional: true)]
    public InboundBulkTemplateMessage|InboundBulkContentMessage|null $message;

    /**
     * JSON that is merged into the request sent by Courier to the provider
     * to override properties or to gain access to features in the provider
     * API that are not natively supported by Courier.
     */
    #[Api(optional: true)]
    public mixed $override;

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
     * @param array<string, mixed>|null $locale
     */
    public static function with(
        ?string $brand = null,
        ?array $data = null,
        ?string $event = null,
        ?array $locale = null,
        InboundBulkTemplateMessage|InboundBulkContentMessage|null $message = null,
        mixed $override = null,
    ): self {
        $obj = new self;

        null !== $brand && $obj->brand = $brand;
        null !== $data && $obj->data = $data;
        null !== $event && $obj->event = $event;
        null !== $locale && $obj->locale = $locale;
        null !== $message && $obj->message = $message;
        null !== $override && $obj->override = $override;

        return $obj;
    }

    /**
     * A unique identifier that represents the brand that should be used
     * for rendering the notification.
     */
    public function withBrand(?string $brand): self
    {
        $obj = clone $this;
        $obj->brand = $brand;

        return $obj;
    }

    /**
     * JSON that includes any data you want to pass to a message template.
     * The data will populate the corresponding template variables.
     *
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
     * @param array<string, mixed>|null $locale
     */
    public function withLocale(?array $locale): self
    {
        $obj = clone $this;
        $obj->locale = $locale;

        return $obj;
    }

    /**
     * Describes the content of the message in a way that will
     * work for email, push, chat, or any channel.
     */
    public function withMessage(
        InboundBulkTemplateMessage|InboundBulkContentMessage|null $message
    ): self {
        $obj = clone $this;
        $obj->message = $message;

        return $obj;
    }

    /**
     * JSON that is merged into the request sent by Courier to the provider
     * to override properties or to gain access to features in the provider
     * API that are not natively supported by Courier.
     */
    public function withOverride(mixed $override): self
    {
        $obj = clone $this;
        $obj->override = $override;

        return $obj;
    }
}
