<?php

declare(strict_types=1);

namespace Courier\Profiles;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * When using `PUT`, be sure to include all the key-value pairs required by the recipient's profile.
 * Any key-value pairs that exist in the profile but fail to be included in the `PUT` request will be
 * removed from the profile. Remember, a `PUT` update is a full replacement of the data. For partial updates,
 * use the [Patch](https://www.courier.com/docs/reference/profiles/patch/) request.
 *
 * @see Courier\Profiles->replace
 *
 * @phpstan-type profile_replace_params = array{profile: array<string, mixed>}
 */
final class ProfileReplaceParams implements BaseModel
{
    /** @use SdkModel<profile_replace_params> */
    use SdkModel;
    use SdkParams;

    /** @var array<string, mixed> $profile */
    #[Api(map: 'mixed')]
    public array $profile;

    /**
     * `new ProfileReplaceParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProfileReplaceParams::with(profile: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProfileReplaceParams)->withProfile(...)
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
     * @param array<string, mixed> $profile
     */
    public static function with(array $profile): self
    {
        $obj = new self;

        $obj->profile = $profile;

        return $obj;
    }

    /**
     * @param array<string, mixed> $profile
     */
    public function withProfile(array $profile): self
    {
        $obj = clone $this;
        $obj->profile = $profile;

        return $obj;
    }
}
