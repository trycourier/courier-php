<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Request body for invoking a journey. Requires either a user identifier or a profile with contact information. User identifiers can be provided via user_id field, or resolved from profile/data objects (user_id, userId, or anonymousId fields).
 *
 * @phpstan-type JourneysInvokeRequestShape = array{
 *   data?: array<string,mixed>|null,
 *   profile?: array<string,mixed>|null,
 *   userID?: string|null,
 * }
 */
final class JourneysInvokeRequest implements BaseModel
{
    /** @use SdkModel<JourneysInvokeRequestShape> */
    use SdkModel;

    /**
     * Data payload passed to the journey. The expected shape can be predefined using the schema builder in the journey editor. This data is available in journey steps for condition evaluation and template variable interpolation. Can also contain user identifiers (user_id, userId, anonymousId) if not provided elsewhere.
     *
     * @var array<string,mixed>|null $data
     */
    #[Optional(map: 'mixed')]
    public ?array $data;

    /**
     * Profile data for the user. Can contain contact information (email, phone_number), user identifiers (user_id, userId, anonymousId), or any custom profile fields. Profile fields are merged with any existing stored profile for the user. Include context.tenant_id to load a tenant-scoped profile for multi-tenant scenarios.
     *
     * @var array<string,mixed>|null $profile
     */
    #[Optional(map: 'mixed')]
    public ?array $profile;

    /**
     * A unique identifier for the user. If not provided, the system will attempt to resolve the user identifier from profile or data objects.
     */
    #[Optional('user_id')]
    public ?string $userID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,mixed>|null $data
     * @param array<string,mixed>|null $profile
     */
    public static function with(
        ?array $data = null,
        ?array $profile = null,
        ?string $userID = null
    ): self {
        $self = new self;

        null !== $data && $self['data'] = $data;
        null !== $profile && $self['profile'] = $profile;
        null !== $userID && $self['userID'] = $userID;

        return $self;
    }

    /**
     * Data payload passed to the journey. The expected shape can be predefined using the schema builder in the journey editor. This data is available in journey steps for condition evaluation and template variable interpolation. Can also contain user identifiers (user_id, userId, anonymousId) if not provided elsewhere.
     *
     * @param array<string,mixed> $data
     */
    public function withData(array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * Profile data for the user. Can contain contact information (email, phone_number), user identifiers (user_id, userId, anonymousId), or any custom profile fields. Profile fields are merged with any existing stored profile for the user. Include context.tenant_id to load a tenant-scoped profile for multi-tenant scenarios.
     *
     * @param array<string,mixed> $profile
     */
    public function withProfile(array $profile): self
    {
        $self = clone $this;
        $self['profile'] = $profile;

        return $self;
    }

    /**
     * A unique identifier for the user. If not provided, the system will attempt to resolve the user identifier from profile or data objects.
     */
    public function withUserID(string $userID): self
    {
        $self = clone $this;
        $self['userID'] = $userID;

        return $self;
    }
}
