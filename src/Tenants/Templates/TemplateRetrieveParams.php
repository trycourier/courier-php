<?php

declare(strict_types=1);

namespace Courier\Tenants\Templates;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Get a Template in Tenant.
 *
 * @see Courier\Services\Tenants\TemplatesService::retrieve()
 *
 * @phpstan-type TemplateRetrieveParamsShape = array{tenantID: string}
 */
final class TemplateRetrieveParams implements BaseModel
{
    /** @use SdkModel<TemplateRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $tenantID;

    /**
     * `new TemplateRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TemplateRetrieveParams::with(tenantID: ...)
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
    public static function with(string $tenantID): self
    {
        $obj = new self;

        $obj['tenantID'] = $tenantID;

        return $obj;
    }

    public function withTenantID(string $tenantID): self
    {
        $obj = clone $this;
        $obj['tenantID'] = $tenantID;

        return $obj;
    }
}
