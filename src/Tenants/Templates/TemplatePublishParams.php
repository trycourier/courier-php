<?php

declare(strict_types=1);

namespace Courier\Tenants\Templates;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Publishes a specific version of a notification template for a tenant.
 *
 * The template must already exist in the tenant's notification map.
 * If no version is specified, defaults to publishing the "latest" version.
 *
 * @see Courier\Services\Tenants\TemplatesService::publish()
 *
 * @phpstan-type TemplatePublishParamsShape = array{
 *   tenantID: string, version?: string|null
 * }
 */
final class TemplatePublishParams implements BaseModel
{
    /** @use SdkModel<TemplatePublishParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $tenantID;

    /**
     * The version of the template to publish (e.g., "v1", "v2", "latest"). If not provided, defaults to "latest".
     */
    #[Optional]
    public ?string $version;

    /**
     * `new TemplatePublishParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TemplatePublishParams::with(tenantID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TemplatePublishParams)->withTenantID(...)
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
    public static function with(string $tenantID, ?string $version = null): self
    {
        $self = new self;

        $self['tenantID'] = $tenantID;

        null !== $version && $self['version'] = $version;

        return $self;
    }

    public function withTenantID(string $tenantID): self
    {
        $self = clone $this;
        $self['tenantID'] = $tenantID;

        return $self;
    }

    /**
     * The version of the template to publish (e.g., "v1", "v2", "latest"). If not provided, defaults to "latest".
     */
    public function withVersion(string $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }
}
