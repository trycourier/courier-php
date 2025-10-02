<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class MsTeamsBaseProperties extends JsonSerializableType
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

    /**
     * @param array{
     *   tenantId: string,
     *   serviceUrl: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->tenantId = $values['tenantId'];
        $this->serviceUrl = $values['serviceUrl'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
