<?php

namespace Courier\Bulk\Traits;

use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

trait InboundBulkMessageV1
{
    /**
     * @var ?string $brand A unique identifier that represents the brand that should be used
    for rendering the notification.
     */
    #[JsonProperty('brand')]
    public ?string $brand;

    /**
     * @var ?array<string, mixed> $data JSON that includes any data you want to pass to a message template.
    The data will populate the corresponding template variables.
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
     * @var mixed $override JSON that is merged into the request sent by Courier to the provider
    to override properties or to gain access to features in the provider
    API that are not natively supported by Courier.
     */
    #[JsonProperty('override')]
    public mixed $override;
}
