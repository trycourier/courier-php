<?php

namespace Courier\Commons\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Commons\Traits\BaseTemplateTenantAssociation;
use Courier\Core\Json\JsonProperty;

class ListTemplateTenantAssociation extends JsonSerializableType
{
    use BaseTemplateTenantAssociation;

    /**
     * @var TenantTemplateDataNoContent $data
     */
    #[JsonProperty('data')]
    public TenantTemplateDataNoContent $data;

    /**
     * @param array{
     *   id: string,
     *   createdAt: string,
     *   updatedAt: string,
     *   publishedAt: string,
     *   version: string,
     *   data: TenantTemplateDataNoContent,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->createdAt = $values['createdAt'];
        $this->updatedAt = $values['updatedAt'];
        $this->publishedAt = $values['publishedAt'];
        $this->version = $values['version'];
        $this->data = $values['data'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
