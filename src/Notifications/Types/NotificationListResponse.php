<?php

namespace Courier\Notifications\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Commons\Types\Paging;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class NotificationListResponse extends JsonSerializableType
{
    /**
     * @var Paging $paging
     */
    #[JsonProperty('paging')]
    public Paging $paging;

    /**
     * @var array<Notification> $results
     */
    #[JsonProperty('results'), ArrayType([Notification::class])]
    public array $results;

    /**
     * @param array{
     *   paging: Paging,
     *   results: array<Notification>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->paging = $values['paging'];
        $this->results = $values['results'];
    }
}
