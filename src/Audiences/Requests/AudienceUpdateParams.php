<?php

namespace Courier\Audiences\Requests;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Audiences\Types\SingleFilterConfig;
use Courier\Audiences\Types\NestedFilterConfig;
use Courier\Core\Types\Union;

class AudienceUpdateParams extends JsonSerializableType
{
    /**
     * @var ?string $name The name of the audience
     */
    #[JsonProperty('name')]
    public ?string $name;

    /**
     * @var ?string $description A description of the audience
     */
    #[JsonProperty('description')]
    public ?string $description;

    /**
     * @var (
     *    SingleFilterConfig
     *   |NestedFilterConfig
     * )|null $filter
     */
    #[JsonProperty('filter'), Union(SingleFilterConfig::class, NestedFilterConfig::class, 'null')]
    public SingleFilterConfig|NestedFilterConfig|null $filter;

    /**
     * @param array{
     *   name?: ?string,
     *   description?: ?string,
     *   filter?: (
     *    SingleFilterConfig
     *   |NestedFilterConfig
     * )|null,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->name = $values['name'] ?? null;
        $this->description = $values['description'] ?? null;
        $this->filter = $values['filter'] ?? null;
    }
}
