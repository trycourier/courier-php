<?php

namespace Courier\Inbound\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class TrackAcceptedResponse extends JsonSerializableType
{
    /**
     * @var string $messageId A successful call returns a `202` status code along with a `requestId` in the response body.
     */
    #[JsonProperty('messageId')]
    public string $messageId;

    /**
     * @param array{
     *   messageId: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->messageId = $values['messageId'];
    }
}
