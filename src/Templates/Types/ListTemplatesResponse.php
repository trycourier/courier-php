<?php

namespace Courier\Templates\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Commons\Types\Paging;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class ListTemplatesResponse extends JsonSerializableType
{
    /**
     * @var Paging $paging
     */
    #[JsonProperty('paging')]
    public Paging $paging;

    /**
     * @var array<NotificationTemplates> $results An array of Notification Templates
     */
    #[JsonProperty('results'), ArrayType([NotificationTemplates::class])]
    public array $results;

    /**
     * @param array{
     *   paging: Paging,
     *   results: array<NotificationTemplates>,
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
