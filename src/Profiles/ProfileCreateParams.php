<?php

declare(strict_types=1);

namespace Courier\Profiles;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new ProfileCreateParams); // set properties as needed
 * $client->profiles->create(...$params->toArray());
 * ```
 * Merge the supplied values with an existing profile or create a new profile if one doesn't already exist.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->profiles->create(...$params->toArray());`
 *
 * @see Courier\Profiles->create
 *
 * @phpstan-type profile_create_params = array{profile: array<string, mixed>}
 */
final class ProfileCreateParams implements BaseModel
{
    /** @use SdkModel<profile_create_params> */
    use SdkModel;
    use SdkParams;

    /** @var array<string, mixed> $profile */
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
