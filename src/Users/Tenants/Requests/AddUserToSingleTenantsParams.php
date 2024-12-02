<?php

namespace Courier\Users\Tenants\Requests;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class AddUserToSingleTenantsParams extends JsonSerializableType
{
    /**
     * @var ?array<string, mixed> $profile
     */
    #[JsonProperty('profile'), ArrayType(['string' => 'mixed'])]
    public ?array $profile;

    /**
     * @param array{
     *   profile?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->profile = $values['profile'] ?? null;
    }
}
