<?php

declare(strict_types=1);

namespace Courier\Profiles;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Profiles\ProfileUpdateParams\Patch;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new ProfileUpdateParams); // set properties as needed
 * $client->profiles->update(...$params->toArray());
 * ```
 * Update a profile.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->profiles->update(...$params->toArray());`
 *
 * @see Courier\Profiles->update
 *
 * @phpstan-type profile_update_params = array{patch: list<Patch>}
 */
final class ProfileUpdateParams implements BaseModel
{
    /** @use SdkModel<profile_update_params> */
    use SdkModel;
    use SdkParams;

    /**
     * List of patch operations to apply to the profile.
     *
     * @var list<Patch> $patch
     */
    #[Api(list: Patch::class)]
    public array $patch;

    /**
     * `new ProfileUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProfileUpdateParams::with(patch: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProfileUpdateParams)->withPatch(...)
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
     * @param list<Patch> $patch
     */
    public static function with(array $patch): self
    {
        $obj = new self;

        $obj->patch = $patch;

        return $obj;
    }

    /**
     * List of patch operations to apply to the profile.
     *
     * @param list<Patch> $patch
     */
    public function withPatch(array $patch): self
    {
        $obj = clone $this;
        $obj->patch = $patch;

        return $obj;
    }
}
