<?php

declare(strict_types=1);

namespace Courier\Profiles;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Profiles\ProfileUpdateParams\Patch;

/**
 * Update a profile.
 *
 * @see Courier\Services\ProfilesService::update()
 *
 * @phpstan-type ProfileUpdateParamsShape = array{
 *   patch: list<Patch|array{op: string, path: string, value: string}>
 * }
 */
final class ProfileUpdateParams implements BaseModel
{
    /** @use SdkModel<ProfileUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * List of patch operations to apply to the profile.
     *
     * @var list<Patch> $patch
     */
    #[Required(list: Patch::class)]
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
     * @param list<Patch|array{op: string, path: string, value: string}> $patch
     */
    public static function with(array $patch): self
    {
        $self = new self;

        $self['patch'] = $patch;

        return $self;
    }

    /**
     * List of patch operations to apply to the profile.
     *
     * @param list<Patch|array{op: string, path: string, value: string}> $patch
     */
    public function withPatch(array $patch): self
    {
        $self = clone $this;
        $self['patch'] = $patch;

        return $self;
    }
}
