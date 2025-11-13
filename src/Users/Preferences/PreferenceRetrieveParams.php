<?php

declare(strict_types=1);

namespace Courier\Users\Preferences;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Fetch all user preferences.
 *
 * @see Courier\Services\Users\PreferencesService::retrieve()
 *
 * @phpstan-type PreferenceRetrieveParamsShape = array{tenant_id?: string|null}
 */
final class PreferenceRetrieveParams implements BaseModel
{
    /** @use SdkModel<PreferenceRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Query the preferences of a user for this specific tenant context.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $tenant_id;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $tenant_id = null): self
    {
        $obj = new self;

        null !== $tenant_id && $obj->tenant_id = $tenant_id;

        return $obj;
    }

    /**
     * Query the preferences of a user for this specific tenant context.
     */
    public function withTenantID(?string $tenantID): self
    {
        $obj = clone $this;
        $obj->tenant_id = $tenantID;

        return $obj;
    }
}
