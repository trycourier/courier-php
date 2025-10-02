<?php

namespace Courier\Bulk\Traits;

use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

/**
 * @property ?string $brand
 * @property ?array<string, mixed> $data
 * @property ?string $event
 * @property ?array<string, mixed> $locale
 * @property mixed $override
 */
trait InboundBulkMessageV1
{
    /**
     * A unique identifier that represents the brand that should be used
     * for rendering the notification.
     *
     * @var ?string $brand
     */
    #[JsonProperty('brand')]
    public ?string $brand;

    /**
     * JSON that includes any data you want to pass to a message template.
     * The data will populate the corresponding template variables.
     *
     * @var ?array<string, mixed> $data
     */
    #[JsonProperty('data'), ArrayType(['string' => 'mixed'])]
    public ?array $data;

    /**
     * @var ?string $event
     */
    #[JsonProperty('event')]
    public ?string $event;

    /**
     * @var ?array<string, mixed> $locale
     */
    #[JsonProperty('locale'), ArrayType(['string' => 'mixed'])]
    public ?array $locale;

    /**
     * JSON that is merged into the request sent by Courier to the provider
     * to override properties or to gain access to features in the provider
     * API that are not natively supported by Courier.
     *
     * @var mixed $override
     */
    #[JsonProperty('override')]
    public mixed $override;
}
