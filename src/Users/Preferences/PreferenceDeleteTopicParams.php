<?php

declare(strict_types=1);

namespace Courier\Users\Preferences;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Removes a user's override for one subscription topic, resetting it to the effective default from the tenant or workspace.
 *
 * @see Courier\Services\Users\PreferencesService::deleteTopic()
 *
 * @phpstan-type PreferenceDeleteTopicParamsShape = array{
 *   userID: string, tenantID?: string|null
 * }
 */
final class PreferenceDeleteTopicParams implements BaseModel
{
    /** @use SdkModel<PreferenceDeleteTopicParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $userID;

    /**
     * Delete the preferences of a user for this specific tenant context.
     */
    #[Optional(nullable: true)]
    public ?string $tenantID;

    /**
     * `new PreferenceDeleteTopicParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreferenceDeleteTopicParams::with(userID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreferenceDeleteTopicParams)->withUserID(...)
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
        $self = new self;

        $self['userID'] = $userID;

        null !== $tenantID && $self['tenantID'] = $tenantID;

        return $self;
    }

    public function withUserID(string $userID): self
    {
        $self = clone $this;
        $self['userID'] = $userID;

        return $self;
    }

    /**
     * Delete the preferences of a user for this specific tenant context.
     */
    public function withTenantID(?string $tenantID): self
    {
        $self = clone $this;
        $self['tenantID'] = $tenantID;

        return $self;
    }
}
