<?php

namespace Courier\Bulk\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class InboundBulkMessageV1 extends JsonSerializableType
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

    /**
     * @param array{
     *   brand?: ?string,
     *   data?: ?array<string, mixed>,
     *   event?: ?string,
     *   locale?: ?array<string, mixed>,
     *   override?: mixed,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->brand = $values['brand'] ?? null;
        $this->data = $values['data'] ?? null;
        $this->event = $values['event'] ?? null;
        $this->locale = $values['locale'] ?? null;
        $this->override = $values['override'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
