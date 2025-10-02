<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class AirshipProfileAudience extends JsonSerializableType
{
    /**
     * @var string $namedUser
     */
    #[JsonProperty('named_user')]
    public string $namedUser;

    /**
     * @param array{
     *   namedUser: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->namedUser = $values['namedUser'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
