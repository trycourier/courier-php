<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class AirshipProfile extends JsonSerializableType
{
    /**
     * @var AirshipProfileAudience $audience
     */
    #[JsonProperty('audience')]
    public AirshipProfileAudience $audience;

    /**
     * @var array<mixed> $deviceTypes
     */
    #[JsonProperty('device_types'), ArrayType(['mixed'])]
    public array $deviceTypes;

    /**
     * @param array{
     *   audience: AirshipProfileAudience,
     *   deviceTypes: array<mixed>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->audience = $values['audience'];
        $this->deviceTypes = $values['deviceTypes'];
    }
}
