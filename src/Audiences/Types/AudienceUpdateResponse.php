<?php

namespace Courier\Audiences\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class AudienceUpdateResponse extends JsonSerializableType
{
    /**
     * @var Audience $audience
     */
    #[JsonProperty('audience')]
    public Audience $audience;

    /**
     * @param array{
     *   audience: Audience,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->audience = $values['audience'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
