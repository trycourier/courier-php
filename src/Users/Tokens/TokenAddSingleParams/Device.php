<?php

declare(strict_types=1);

namespace Courier\Users\Tokens\TokenAddSingleParams;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Information about the device the token came from.
 *
 * @phpstan-type DeviceShape = array{
 *   ad_id?: string|null,
 *   app_id?: string|null,
 *   device_id?: string|null,
 *   manufacturer?: string|null,
 *   model?: string|null,
 *   platform?: string|null,
 * }
 */
final class Device implements BaseModel
{
    /** @use SdkModel<DeviceShape> */
    use SdkModel;

    /**
     * Id of the advertising identifier.
     */
    #[Optional(nullable: true)]
    public ?string $ad_id;

    /**
     * Id of the application the token is used for.
     */
    #[Optional(nullable: true)]
    public ?string $app_id;

    /**
     * Id of the device the token is associated with.
     */
    #[Optional(nullable: true)]
    public ?string $device_id;

    /**
     * The device manufacturer.
     */
    #[Optional(nullable: true)]
    public ?string $manufacturer;

    /**
     * The device model.
     */
    #[Optional(nullable: true)]
    public ?string $model;

    /**
     * The device platform i.e. android, ios, web.
     */
    #[Optional(nullable: true)]
    public ?string $platform;

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
        ?string $ad_id = null,
        ?string $app_id = null,
        ?string $device_id = null,
        ?string $manufacturer = null,
        ?string $model = null,
        ?string $platform = null,
    ): self {
        $obj = new self;

        null !== $ad_id && $obj['ad_id'] = $ad_id;
        null !== $app_id && $obj['app_id'] = $app_id;
        null !== $device_id && $obj['device_id'] = $device_id;
        null !== $manufacturer && $obj['manufacturer'] = $manufacturer;
        null !== $model && $obj['model'] = $model;
        null !== $platform && $obj['platform'] = $platform;

        return $obj;
    }

    /**
     * Id of the advertising identifier.
     */
    public function withAdID(?string $adID): self
    {
        $obj = clone $this;
        $obj['ad_id'] = $adID;

        return $obj;
    }

    /**
     * Id of the application the token is used for.
     */
    public function withAppID(?string $appID): self
    {
        $obj = clone $this;
        $obj['app_id'] = $appID;

        return $obj;
    }

    /**
     * Id of the device the token is associated with.
     */
    public function withDeviceID(?string $deviceID): self
    {
        $obj = clone $this;
        $obj['device_id'] = $deviceID;

        return $obj;
    }

    /**
     * The device manufacturer.
     */
    public function withManufacturer(?string $manufacturer): self
    {
        $obj = clone $this;
        $obj['manufacturer'] = $manufacturer;

        return $obj;
    }

    /**
     * The device model.
     */
    public function withModel(?string $model): self
    {
        $obj = clone $this;
        $obj['model'] = $model;

        return $obj;
    }

    /**
     * The device platform i.e. android, ios, web.
     */
    public function withPlatform(?string $platform): self
    {
        $obj = clone $this;
        $obj['platform'] = $platform;

        return $obj;
    }
}
