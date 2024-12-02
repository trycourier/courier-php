<?php

namespace Courier\Lists\Requests;

use Courier\Core\Json\JsonSerializableType;

class GetSubscriptionForListRequest extends JsonSerializableType
{
    /**
     * @var ?string $cursor A unique identifier that allows for fetching the next set of list subscriptions
     */
    public ?string $cursor;

    /**
     * @param array{
     *   cursor?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->cursor = $values['cursor'] ?? null;
    }
}
