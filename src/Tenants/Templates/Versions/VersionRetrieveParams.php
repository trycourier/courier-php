<?php

declare(strict_types=1);

namespace Courier\Tenants\Templates\Versions;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Fetches a specific version of a tenant template.
 *
 * Supports the following version formats:
 * - `latest` - The most recent version of the template
 * - `published` - The currently published version
 * - `v{version}` - A specific version (e.g., "v1", "v2", "v1.0.0")
 *
 * @see Courier\Services\Tenants\Templates\VersionsService::retrieve()
 *
 * @phpstan-type VersionRetrieveParamsShape = array{
 *   tenantID: string, templateID: string
 * }
 */
final class VersionRetrieveParams implements BaseModel
{
    /** @use SdkModel<VersionRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $tenantID;

    #[Required]
    public string $templateID;

    /**
     * `new VersionRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VersionRetrieveParams::with(tenantID: ..., templateID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VersionRetrieveParams)->withTenantID(...)->withTemplateID(...)
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
    public static function with(string $tenantID, string $templateID): self
    {
        $self = new self;

        $self['tenantID'] = $tenantID;
        $self['templateID'] = $templateID;

        return $self;
    }

    public function withTenantID(string $tenantID): self
    {
        $self = clone $this;
        $self['tenantID'] = $tenantID;

        return $self;
    }

    public function withTemplateID(string $templateID): self
    {
        $self = clone $this;
        $self['templateID'] = $templateID;

        return $self;
    }
}
