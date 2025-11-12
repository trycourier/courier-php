<?php

declare(strict_types=1);

namespace Courier\Tenants\Templates;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Get a Template in Tenant.
 *
 * @see Courier\Tenants\Templates->retrieve
 *
 * @phpstan-type TemplateRetrieveParamsShape = array{tenant_id: string}
 */
final class TemplateRetrieveParams implements BaseModel
{
    /** @use SdkModel<TemplateRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $tenant_id;

    /**
     * `new TemplateRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TemplateRetrieveParams::with(tenant_id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TemplateRetrieveParams)->withTenantID(...)
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
    public static function with(string $tenant_id): self
    {
        $obj = new self;

        $obj->tenant_id = $tenant_id;

        return $obj;
    }

    public function withTenantID(string $tenantID): self
    {
        $obj = clone $this;
        $obj->tenant_id = $tenantID;

        return $obj;
    }
}
