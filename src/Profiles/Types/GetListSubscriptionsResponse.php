<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Commons\Types\Paging;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class GetListSubscriptionsResponse extends JsonSerializableType
{
    /**
     * @var Paging $paging
     */
    #[JsonProperty('paging')]
    public Paging $paging;

    /**
     * @var array<GetListSubscriptionsList> $results An array of lists
     */
    #[JsonProperty('results'), ArrayType([GetListSubscriptionsList::class])]
    public array $results;

    /**
     * @param array{
     *   paging: Paging,
     *   results: array<GetListSubscriptionsList>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->paging = $values['paging'];
        $this->results = $values['results'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
