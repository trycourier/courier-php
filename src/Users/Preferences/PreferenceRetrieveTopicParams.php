<?php

declare(strict_types=1);

namespace Courier\Users\Preferences;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Fetch user preferences for a specific subscription topic.
 *
 * @see Courier\Services\Users\PreferencesService::retrieveTopic()
 *
 * @phpstan-type PreferenceRetrieveTopicParamsShape = array{
 *   user_id: string, tenant_id?: string|null
 * }
 */
final class PreferenceRetrieveTopicParams implements BaseModel
{
    /** @use SdkModel<PreferenceRetrieveTopicParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $user_id;

    /**
     * Query the preferences of a user for this specific tenant context.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $tenant_id;

    /**
     * `new PreferenceRetrieveTopicParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreferenceRetrieveTopicParams::with(user_id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreferenceRetrieveTopicParams)->withUserID(...)
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
    public static function with(
        string $user_id,
        ?string $tenant_id = null
    ): self {
        $obj = new self;

        $obj->user_id = $user_id;

        null !== $tenant_id && $obj->tenant_id = $tenant_id;

        return $obj;
    }

    public function withUserID(string $userID): self
    {
        $obj = clone $this;
        $obj->user_id = $userID;

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
