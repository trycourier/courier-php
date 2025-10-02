<?php

namespace Courier\Audiences\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\Union;

class Audience extends JsonSerializableType
{
    /**
     * @var string $id A unique identifier representing the audience_id
     */
    #[JsonProperty('id')]
    public string $id;

    /**
     * @var string $name The name of the audience
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var string $description A description of the audience
     */
    #[JsonProperty('description')]
    public string $description;

    /**
     * @var (
     *    SingleFilterConfig
     *   |NestedFilterConfig
     * ) $filter
     */
    #[JsonProperty('filter'), Union(SingleFilterConfig::class, NestedFilterConfig::class)]
    public SingleFilterConfig|NestedFilterConfig $filter;

    /**
     * @var string $createdAt
     */
    #[JsonProperty('created_at')]
    public string $createdAt;

    /**
     * @var string $updatedAt
     */
    #[JsonProperty('updated_at')]
    public string $updatedAt;

    /**
     * @param array{
     *   id: string,
     *   name: string,
     *   description: string,
     *   filter: (
     *    SingleFilterConfig
     *   |NestedFilterConfig
     * ),
     *   createdAt: string,
     *   updatedAt: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->name = $values['name'];
        $this->description = $values['description'];
        $this->filter = $values['filter'];
        $this->createdAt = $values['createdAt'];
        $this->updatedAt = $values['updatedAt'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
