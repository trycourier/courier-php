<?php

namespace Courier\Commons\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class Paging extends JsonSerializableType
{
    /**
     * @var ?string $cursor
     */
    #[JsonProperty('cursor')]
    public ?string $cursor;

    /**
     * @var bool $more
     */
    #[JsonProperty('more')]
    public bool $more;

    /**
     * @param array{
     *   more: bool,
     *   cursor?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->cursor = $values['cursor'] ?? null;
        $this->more = $values['more'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
