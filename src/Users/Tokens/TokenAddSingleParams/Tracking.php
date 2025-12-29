<?php

declare(strict_types=1);

namespace Courier\Users\Tokens\TokenAddSingleParams;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Tracking information about the device the token came from.
 *
 * @phpstan-type TrackingShape = array{
 *   ip?: string|null,
 *   lat?: string|null,
 *   long?: string|null,
 *   osVersion?: string|null,
 * }
 */
final class Tracking implements BaseModel
{
    /** @use SdkModel<TrackingShape> */
    use SdkModel;

    /**
     * The IP address of the device.
     */
    #[Optional(nullable: true)]
    public ?string $ip;

    /**
     * The latitude of the device.
     */
    #[Optional(nullable: true)]
    public ?string $lat;

    /**
     * The longitude of the device.
     */
    #[Optional(nullable: true)]
    public ?string $long;

    /**
     * The operating system version.
     */
    #[Optional('os_version', nullable: true)]
    public ?string $osVersion;

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
        ?string $ip = null,
        ?string $lat = null,
        ?string $long = null,
        ?string $osVersion = null,
    ): self {
        $self = new self;

        null !== $ip && $self['ip'] = $ip;
        null !== $lat && $self['lat'] = $lat;
        null !== $long && $self['long'] = $long;
        null !== $osVersion && $self['osVersion'] = $osVersion;

        return $self;
    }

    /**
     * The IP address of the device.
     */
    public function withIP(?string $ip): self
    {
        $self = clone $this;
        $self['ip'] = $ip;

        return $self;
    }

    /**
     * The latitude of the device.
     */
    public function withLat(?string $lat): self
    {
        $self = clone $this;
        $self['lat'] = $lat;

        return $self;
    }

    /**
     * The longitude of the device.
     */
    public function withLong(?string $long): self
    {
        $self = clone $this;
        $self['long'] = $long;

        return $self;
    }

    /**
     * The operating system version.
     */
    public function withOsVersion(?string $osVersion): self
    {
        $self = clone $this;
        $self['osVersion'] = $osVersion;

        return $self;
    }
}
