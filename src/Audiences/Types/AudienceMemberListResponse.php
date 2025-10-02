<?php

namespace Courier\Audiences\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;
use Courier\Commons\Types\Paging;

class AudienceMemberListResponse extends JsonSerializableType
{
    /**
     * @var array<AudienceMember> $items
     */
    #[JsonProperty('items'), ArrayType([AudienceMember::class])]
    public array $items;

    /**
     * @var Paging $paging
     */
    #[JsonProperty('paging')]
    public Paging $paging;

    /**
     * @param array{
     *   items: array<AudienceMember>,
     *   paging: Paging,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->items = $values['items'];
        $this->paging = $values['paging'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
