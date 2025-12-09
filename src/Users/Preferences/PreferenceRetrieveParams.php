<?php

declare(strict_types=1);

namespace Courier\Users\Preferences;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Fetch all user preferences.
 *
 * @see Courier\Services\Users\PreferencesService::retrieve()
 *
 * @phpstan-type PreferenceRetrieveParamsShape = array{tenantID?: string|null}
 */
final class PreferenceRetrieveParams implements BaseModel
{
    /** @use SdkModel<PreferenceRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Query the preferences of a user for this specific tenant context.
     */
    #[Optional(nullable: true)]
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
        $self = new self;

        null !== $tenantID && $self['tenantID'] = $tenantID;

        return $self;
    }

    /**
     * Query the preferences of a user for this specific tenant context.
     */
    public function withTenantID(?string $tenantID): self
    {
        $self = clone $this;
        $self['tenantID'] = $tenantID;

        return $self;
    }
}
