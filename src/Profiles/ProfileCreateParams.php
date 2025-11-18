<?php

declare(strict_types=1);

namespace Courier\Profiles;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Merge the supplied values with an existing profile or create a new profile if one doesn't already exist.
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
    #[Api(map: 'mixed')]
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
        $obj = new self;

        $obj->profile = $profile;

        return $obj;
    }

    /**
     * @param array<string,mixed> $profile
     */
    public function withProfile(array $profile): self
    {
        $obj = clone $this;
        $obj->profile = $profile;

        return $obj;
    }
}
