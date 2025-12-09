<?php

declare(strict_types=1);

namespace Courier\Users\Preferences;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Fetch user preferences for a specific subscription topic.
 *
 * @see Courier\Services\Users\PreferencesService::retrieveTopic()
 *
 * @phpstan-type PreferenceRetrieveTopicParamsShape = array{
 *   userID: string, tenantID?: string|null
 * }
 */
final class PreferenceRetrieveTopicParams implements BaseModel
{
    /** @use SdkModel<PreferenceRetrieveTopicParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $userID;

    /**
     * Query the preferences of a user for this specific tenant context.
     */
    #[Optional(nullable: true)]
    public ?string $tenantID;

    /**
     * `new PreferenceRetrieveTopicParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreferenceRetrieveTopicParams::with(userID: ...)
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
    public static function with(string $userID, ?string $tenantID = null): self
    {
        $obj = new self;

        $obj['userID'] = $userID;

        null !== $tenantID && $obj['tenantID'] = $tenantID;

        return $obj;
    }

    public function withUserID(string $userID): self
    {
        $obj = clone $this;
        $obj['userID'] = $userID;

        return $obj;
    }

    /**
     * Query the preferences of a user for this specific tenant context.
     */
    public function withTenantID(?string $tenantID): self
    {
        $obj = clone $this;
        $obj['tenantID'] = $tenantID;

        return $obj;
    }
}
