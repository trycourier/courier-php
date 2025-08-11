<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class ProfileUpdateRequest extends JsonSerializableType
{
    /**
     * @var array<UserProfilePatch> $patch List of patch operations to apply to the profile.
     */
    #[JsonProperty('patch'), ArrayType([UserProfilePatch::class])]
    public array $patch;

    /**
     * @param array{
     *   patch: array<UserProfilePatch>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->patch = $values['patch'];
    }
}
