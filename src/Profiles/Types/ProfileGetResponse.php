<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;
use Courier\Commons\Types\RecipientPreferences;

class ProfileGetResponse extends JsonSerializableType
{
    /**
     * @var array<string, mixed> $profile
     */
    #[JsonProperty('profile'), ArrayType(['string' => 'mixed'])]
    public array $profile;

    /**
     * @var ?RecipientPreferences $preferences
     */
    #[JsonProperty('preferences')]
    public ?RecipientPreferences $preferences;

    /**
     * @param array{
     *   profile: array<string, mixed>,
     *   preferences?: ?RecipientPreferences,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->profile = $values['profile'];
        $this->preferences = $values['preferences'] ?? null;
    }
}
