<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Tenant context shared by every MS Teams send variant. Provide at least one of `tenant_id` or `service_url`. If you provide both, they must agree — a `service_url` pointing at a different Microsoft tenant than `tenant_id` is rejected.
 *
 * @phpstan-type MsTeamsBasePropertiesShape = array{
 *   serviceURL?: string|null, tenantID?: string|null
 * }
 */
final class MsTeamsBaseProperties implements BaseModel
{
    /** @use SdkModel<MsTeamsBasePropertiesShape> */
    use SdkModel;

    #[Optional('service_url')]
    public ?string $serviceURL;

    #[Optional('tenant_id')]
    public ?string $tenantID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $serviceURL = null,
        ?string $tenantID = null
    ): self {
        $self = new self;

        null !== $serviceURL && $self['serviceURL'] = $serviceURL;
        null !== $tenantID && $self['tenantID'] = $tenantID;

        return $self;
    }

    public function withServiceURL(string $serviceURL): self
    {
        $self = clone $this;
        $self['serviceURL'] = $serviceURL;

        return $self;
    }

    public function withTenantID(string $tenantID): self
    {
        $self = clone $this;
        $self['tenantID'] = $tenantID;

        return $self;
    }
}
