<?php

declare(strict_types=1);

namespace Courier\Users\Tokens\TokenAddSingleParams;

use Courier\Core\Attributes\Api;
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
    #[Api(nullable: true, optional: true)]
    public ?string $ip;

    /**
     * The latitude of the device.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $lat;

    /**
     * The longitude of the device.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $long;

    /**
     * The operating system version.
     */
    #[Api('os_version', nullable: true, optional: true)]
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
        $obj = new self;

        null !== $ip && $obj->ip = $ip;
        null !== $lat && $obj->lat = $lat;
        null !== $long && $obj->long = $long;
        null !== $osVersion && $obj->osVersion = $osVersion;

        return $obj;
    }

    /**
     * The IP address of the device.
     */
    public function withIP(?string $ip): self
    {
        $obj = clone $this;
        $obj->ip = $ip;

        return $obj;
    }

    /**
     * The latitude of the device.
     */
    public function withLat(?string $lat): self
    {
        $obj = clone $this;
        $obj->lat = $lat;

        return $obj;
    }

    /**
     * The longitude of the device.
     */
    public function withLong(?string $long): self
    {
        $obj = clone $this;
        $obj->long = $long;

        return $obj;
    }

    /**
     * The operating system version.
     */
    public function withOsVersion(?string $osVersion): self
    {
        $obj = clone $this;
        $obj->osVersion = $osVersion;

        return $obj;
    }
}
