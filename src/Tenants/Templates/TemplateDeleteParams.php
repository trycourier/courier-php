<?php

declare(strict_types=1);

namespace Courier\Tenants\Templates;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Deletes a tenant's notification template by id. Sends for that tenant then use the workspace template registered under the same id.
 *
 * @see Courier\Services\Tenants\TemplatesService::delete()
 *
 * @phpstan-type TemplateDeleteParamsShape = array{tenantID: string}
 */
final class TemplateDeleteParams implements BaseModel
{
    /** @use SdkModel<TemplateDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $tenantID;

    /**
     * `new TemplateDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TemplateDeleteParams::with(tenantID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TemplateDeleteParams)->withTenantID(...)
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
        $self = new self;

        $self['tenantID'] = $tenantID;

        return $self;
    }

    public function withTenantID(string $tenantID): self
    {
        $self = clone $this;
        $self['tenantID'] = $tenantID;

        return $self;
    }
}
