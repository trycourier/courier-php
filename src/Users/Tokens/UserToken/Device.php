<?php

declare(strict_types=1);

namespace Courier\Users\Tokens\UserToken;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Information about the device the token came from.
 *
 * @phpstan-type DeviceShape = array{
 *   adID?: string|null,
 *   appID?: string|null,
 *   deviceID?: string|null,
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
    #[Optional('ad_id', nullable: true)]
    public ?string $adID;

    /**
     * Id of the application the token is used for.
     */
    #[Optional('app_id', nullable: true)]
    public ?string $appID;

    /**
     * Id of the device the token is associated with.
     */
    #[Optional('device_id', nullable: true)]
    public ?string $deviceID;

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
        ?string $adID = null,
        ?string $appID = null,
        ?string $deviceID = null,
        ?string $manufacturer = null,
        ?string $model = null,
        ?string $platform = null,
    ): self {
        $self = new self;

        null !== $adID && $self['adID'] = $adID;
        null !== $appID && $self['appID'] = $appID;
        null !== $deviceID && $self['deviceID'] = $deviceID;
        null !== $manufacturer && $self['manufacturer'] = $manufacturer;
        null !== $model && $self['model'] = $model;
        null !== $platform && $self['platform'] = $platform;

        return $self;
    }

    /**
     * Id of the advertising identifier.
     */
    public function withAdID(?string $adID): self
    {
        $self = clone $this;
        $self['adID'] = $adID;

        return $self;
    }

    /**
     * Id of the application the token is used for.
     */
    public function withAppID(?string $appID): self
    {
        $self = clone $this;
        $self['appID'] = $appID;

        return $self;
    }

    /**
     * Id of the device the token is associated with.
     */
    public function withDeviceID(?string $deviceID): self
    {
        $self = clone $this;
        $self['deviceID'] = $deviceID;

        return $self;
    }

    /**
     * The device manufacturer.
     */
    public function withManufacturer(?string $manufacturer): self
    {
        $self = clone $this;
        $self['manufacturer'] = $manufacturer;

        return $self;
    }

    /**
     * The device model.
     */
    public function withModel(?string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    /**
     * The device platform i.e. android, ios, web.
     */
    public function withPlatform(?string $platform): self
    {
        $self = clone $this;
        $self['platform'] = $platform;

        return $self;
    }
}
