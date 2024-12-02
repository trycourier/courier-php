<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class Address extends JsonSerializableType
{
    /**
     * @var string $formatted
     */
    #[JsonProperty('formatted')]
    public string $formatted;

    /**
     * @var string $streetAddress
     */
    #[JsonProperty('street_address')]
    public string $streetAddress;

    /**
     * @var string $locality
     */
    #[JsonProperty('locality')]
    public string $locality;

    /**
     * @var string $region
     */
    #[JsonProperty('region')]
    public string $region;

    /**
     * @var string $postalCode
     */
    #[JsonProperty('postal_code')]
    public string $postalCode;

    /**
     * @var string $country
     */
    #[JsonProperty('country')]
    public string $country;

    /**
     * @param array{
     *   formatted: string,
     *   streetAddress: string,
     *   locality: string,
     *   region: string,
     *   postalCode: string,
     *   country: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->formatted = $values['formatted'];
        $this->streetAddress = $values['streetAddress'];
        $this->locality = $values['locality'];
        $this->region = $values['region'];
        $this->postalCode = $values['postalCode'];
        $this->country = $values['country'];
    }
}
