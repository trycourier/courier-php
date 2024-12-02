<?php

namespace Courier\Lists\Requests;

use Courier\Core\Json\JsonSerializableType;

class GetAllListsRequest extends JsonSerializableType
{
    /**
     * @var ?string $cursor A unique identifier that allows for fetching the next page of lists.
     */
    public ?string $cursor;

    /**
     * @var ?string $pattern "A pattern used to filter the list items returned. Pattern types supported: exact match on `list_id` or a pattern of one or more pattern parts. you may replace a part with either: `*` to match all parts in that position, or `**` to signify a wildcard `endsWith` pattern match."
     */
    public ?string $pattern;

    /**
     * @param array{
     *   cursor?: ?string,
     *   pattern?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->cursor = $values['cursor'] ?? null;
        $this->pattern = $values['pattern'] ?? null;
    }
}
