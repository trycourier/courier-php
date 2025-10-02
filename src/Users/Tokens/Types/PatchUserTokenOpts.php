<?php

namespace Courier\Users\Tokens\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class PatchUserTokenOpts extends JsonSerializableType
{
    /**
     * @var array<PatchOperation> $patch
     */
    #[JsonProperty('patch'), ArrayType([PatchOperation::class])]
    public array $patch;

    /**
     * @param array{
     *   patch: array<PatchOperation>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->patch = $values['patch'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
