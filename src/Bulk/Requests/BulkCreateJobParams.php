<?php

namespace Courier\Bulk\Requests;

use Courier\Core\Json\JsonSerializableType;
use Courier\Bulk\Types\InboundBulkMessage;
use Courier\Core\Json\JsonProperty;

class BulkCreateJobParams extends JsonSerializableType
{
    /**
     * @var InboundBulkMessage $message
     */
    #[JsonProperty('message')]
    public InboundBulkMessage $message;

    /**
     * @param array{
     *   message: InboundBulkMessage,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->message = $values['message'];
    }
}
