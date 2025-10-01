<?php

declare(strict_types=1);

namespace Courier\Send;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type ms_teams_base_properties = array{
 *   serviceURL: string, tenantID: string
 * }
 */
final class MsTeamsBaseProperties implements BaseModel
{
    /** @use SdkModel<ms_teams_base_properties> */
    use SdkModel;

    #[Api('service_url')]
    public string $serviceURL;

    #[Api('tenant_id')]
    public string $tenantID;

    /**
     * `new MsTeamsBaseProperties()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MsTeamsBaseProperties::with(serviceURL: ..., tenantID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MsTeamsBaseProperties)->withServiceURL(...)->withTenantID(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $serviceURL, string $tenantID): self
    {
        $obj = new self;

        $obj->serviceURL = $serviceURL;
        $obj->tenantID = $tenantID;

        return $obj;
    }

    public function withServiceURL(string $serviceURL): self
    {
        $obj = clone $this;
        $obj->serviceURL = $serviceURL;

        return $obj;
    }

    public function withTenantID(string $tenantID): self
    {
        $obj = clone $this;
        $obj->tenantID = $tenantID;

        return $obj;
    }
}
