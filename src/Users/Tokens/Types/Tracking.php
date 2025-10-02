<?php

namespace Courier\Users\Tokens\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class Tracking extends JsonSerializableType
{
    /**
     * @var ?string $osVersion The operating system version
     */
    #[JsonProperty('os_version')]
    public ?string $osVersion;

    /**
     * @var ?string $ip The IP address of the device
     */
    #[JsonProperty('ip')]
    public ?string $ip;

    /**
     * @var ?string $lat The latitude of the device
     */
    #[JsonProperty('lat')]
    public ?string $lat;

    /**
     * @var ?string $long The longitude of the device
     */
    #[JsonProperty('long')]
    public ?string $long;

    /**
     * @param array{
     *   osVersion?: ?string,
     *   ip?: ?string,
     *   lat?: ?string,
     *   long?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->osVersion = $values['osVersion'] ?? null;
        $this->ip = $values['ip'] ?? null;
        $this->lat = $values['lat'] ?? null;
        $this->long = $values['long'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
