<?php

namespace Courier\Brands\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Commons\Types\Paging;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class BrandGetAllResponse extends JsonSerializableType
{
    /**
     * @var Paging $paging
     */
    #[JsonProperty('paging')]
    public Paging $paging;

    /**
     * @var array<Brand> $results
     */
    #[JsonProperty('results'), ArrayType([Brand::class])]
    public array $results;

    /**
     * @param array{
     *   paging: Paging,
     *   results: array<Brand>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->paging = $values['paging'];
        $this->results = $values['results'];
    }
}
