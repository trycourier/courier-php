<?php

namespace Courier\Bulk\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Bulk\Traits\InboundBulkMessageV1;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\Union;

class InboundBulkMessage extends JsonSerializableType
{
    use InboundBulkMessageV1;

    /**
     * @var InboundBulkTemplateMessage|InboundBulkContentMessage|null $message
     */
    #[JsonProperty('message'), Union(InboundBulkTemplateMessage::class, InboundBulkContentMessage::class, 'null')]
    public InboundBulkTemplateMessage|InboundBulkContentMessage|null $message;

    /**
     * @param array{
     *   message?: InboundBulkTemplateMessage|InboundBulkContentMessage|null,
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
        $this->message = $values['message'] ?? null;
        $this->brand = $values['brand'] ?? null;
        $this->data = $values['data'] ?? null;
        $this->event = $values['event'] ?? null;
        $this->locale = $values['locale'] ?? null;
        $this->override = $values['override'] ?? null;
    }
}
