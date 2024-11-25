<?php

namespace Courier\Profiles\Requests;

use Courier\Core\Json\JsonSerializableType;

class GetListSubscriptionsRequest extends JsonSerializableType
{
    /**
     * @var ?string $cursor A unique identifier that allows for fetching the next set of message statuses.
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
