<?php

namespace Courier\Tenants\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Commons\Traits\SingleTemplateTenantAssociation;
use Courier\Commons\Types\TenantTemplateData;

class GetTemplateByTenantResponse extends JsonSerializableType
{
    use SingleTemplateTenantAssociation;


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
