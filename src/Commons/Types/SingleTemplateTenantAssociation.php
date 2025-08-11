<?php

namespace Courier\Commons\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Commons\Traits\BaseTemplateTenantAssociation;
use Courier\Core\Json\JsonProperty;

class SingleTemplateTenantAssociation extends JsonSerializableType
{
    use BaseTemplateTenantAssociation;

    /**
     * @var TenantTemplateData $data
     */
    #[JsonProperty('data')]
    public TenantTemplateData $data;

    /**
     * @param array{
     *   data: TenantTemplateData,
     *   id: string,
     *   createdAt: string,
     *   updatedAt: string,
     *   publishedAt: string,
     *   version: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->data = $values['data'];
        $this->id = $values['id'];
        $this->createdAt = $values['createdAt'];
        $this->updatedAt = $values['updatedAt'];
        $this->publishedAt = $values['publishedAt'];
        $this->version = $values['version'];
    }
}
