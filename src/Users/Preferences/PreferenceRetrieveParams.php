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
 * @see Courier\Users\Preferences->retrieve
 *
 * @phpstan-type preference_retrieve_params = array{tenantID?: string|null}
 */
final class PreferenceRetrieveParams implements BaseModel
{
    /** @use SdkModel<preference_retrieve_params> */
    use SdkModel;
    use SdkParams;

    /**
     * Query the preferences of a user for this specific tenant context.
     */
    #[Api(nullable: true, optional: true)]
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
    public static function with(?string $tenantID = null): self
    {
        $obj = new self;

        null !== $tenantID && $obj->tenantID = $tenantID;

        return $obj;
    }

    /**
     * Query the preferences of a user for this specific tenant context.
     */
    public function withTenantID(?string $tenantID): self
    {
        $obj = clone $this;
        $obj->tenantID = $tenantID;

        return $obj;
    }
}
