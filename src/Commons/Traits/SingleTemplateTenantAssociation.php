<?php

namespace Courier\Commons\Traits;

use Courier\Commons\Types\TenantTemplateData;
use Courier\Core\Json\JsonProperty;

trait SingleTemplateTenantAssociation
{
    use BaseTemplateTenantAssociation;

    /**
     * @var TenantTemplateData $data
     */
    #[JsonProperty('data')]
    public TenantTemplateData $data;
}
