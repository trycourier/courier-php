<?php

namespace Courier\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class SendMessageResponse extends JsonSerializableType
{
    /**
     * A successful call to `POST /send` returns a `202` status code along with a `requestId` in the response body.
     *
     * For send requests that have a single recipient, the `requestId` is assigned to the derived message as its message_id. Therefore the `requestId` can be supplied to the Message's API for single recipient messages.
     *
     * For send requests that have multiple recipients (accounts, audiences, lists, etc.), Courier assigns a unique id to each derived message as its `message_id`. Therefore the `requestId` cannot be supplied to the Message's API for single-recipient messages.
     *
     * @var string $requestId
     */
    #[JsonProperty('requestId')]
    public string $requestId;

    /**
     * @param array{
     *   requestId: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->requestId = $values['requestId'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
