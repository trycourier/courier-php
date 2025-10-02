<?php

namespace Courier\Profiles\Traits;

use Courier\Core\Json\JsonProperty;

/**
 * @property string $tenantId
 * @property string $serviceUrl
 */
trait MsTeamsBaseProperties
{
    /**
     * @var string $tenantId
     */
    #[JsonProperty('tenant_id')]
    public string $tenantId;

    /**
     * @var string $serviceUrl
     */
    #[JsonProperty('service_url')]
    public string $serviceUrl;
}
