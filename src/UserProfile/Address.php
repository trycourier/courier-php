<?php

declare(strict_types=1);

namespace Courier\UserProfile;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type AddressShape = array{
 *   country: string,
 *   formatted: string,
 *   locality: string,
 *   postalCode: string,
 *   region: string,
 *   streetAddress: string,
 * }
 */
final class Address implements BaseModel
{
    /** @use SdkModel<AddressShape> */
    use SdkModel;

    #[Required]
    public string $country;

    #[Required]
    public string $formatted;

    #[Required]
    public string $locality;

    #[Required('postal_code')]
    public string $postalCode;

    #[Required]
    public string $region;

    #[Required('street_address')]
    public string $streetAddress;

    /**
     * `new Address()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Address::with(
     *   country: ...,
     *   formatted: ...,
     *   locality: ...,
     *   postalCode: ...,
     *   region: ...,
     *   streetAddress: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Address)
     *   ->withCountry(...)
     *   ->withFormatted(...)
     *   ->withLocality(...)
     *   ->withPostalCode(...)
     *   ->withRegion(...)
     *   ->withStreetAddress(...)
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
     */
    public static function with(
        string $country,
        string $formatted,
        string $locality,
        string $postalCode,
        string $region,
        string $streetAddress,
    ): self {
        $self = new self;

        $self['country'] = $country;
        $self['formatted'] = $formatted;
        $self['locality'] = $locality;
        $self['postalCode'] = $postalCode;
        $self['region'] = $region;
        $self['streetAddress'] = $streetAddress;

        return $self;
    }

    public function withCountry(string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    public function withFormatted(string $formatted): self
    {
        $self = clone $this;
        $self['formatted'] = $formatted;

        return $self;
    }

    public function withLocality(string $locality): self
    {
        $self = clone $this;
        $self['locality'] = $locality;

        return $self;
    }

    public function withPostalCode(string $postalCode): self
    {
        $self = clone $this;
        $self['postalCode'] = $postalCode;

        return $self;
    }

    public function withRegion(string $region): self
    {
        $self = clone $this;
        $self['region'] = $region;

        return $self;
    }

    public function withStreetAddress(string $streetAddress): self
    {
        $self = clone $this;
        $self['streetAddress'] = $streetAddress;

        return $self;
    }
}
