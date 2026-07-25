<?php

declare(strict_types=1);

namespace Courier\Profiles;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Merges the supplied values into a user's profile, creating it if absent and leaving any key you omit untouched. Prefer this for everyday writes.
 *
 * @see Courier\Services\ProfilesService::create()
 *
 * @phpstan-type ProfileCreateParamsShape = array{profile: array<string,mixed>}
 */
final class ProfileCreateParams implements BaseModel
{
    /** @use SdkModel<ProfileCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /** @var array<string,mixed> $profile */
    #[Required(map: 'mixed')]
    public array $profile;

    /**
     * `new ProfileCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProfileCreateParams::with(profile: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProfileCreateParams)->withProfile(...)
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
     *
     * @param array<string,mixed> $profile
     */
    public static function with(array $profile): self
    {
        $self = new self;

        $self['profile'] = $profile;

        return $self;
    }

    /**
     * @param array<string,mixed> $profile
     */
    public function withProfile(array $profile): self
    {
        $self = clone $this;
        $self['profile'] = $profile;

        return $self;
    }
}
