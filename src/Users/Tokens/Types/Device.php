<?php

namespace Courier\Users\Tokens\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class Device extends JsonSerializableType
{
    /**
     * @var ?string $appId Id of the application the token is used for
     */
    #[JsonProperty('app_id')]
    public ?string $appId;

    /**
     * @var ?string $adId Id of the advertising identifier
     */
    #[JsonProperty('ad_id')]
    public ?string $adId;

    /**
     * @var ?string $deviceId Id of the device the token is associated with
     */
    #[JsonProperty('device_id')]
    public ?string $deviceId;

    /**
     * @var ?string $platform The device platform i.e. android, ios, web
     */
    #[JsonProperty('platform')]
    public ?string $platform;

    /**
     * @var ?string $manufacturer The device manufacturer
     */
    #[JsonProperty('manufacturer')]
    public ?string $manufacturer;

    /**
     * @var ?string $model The device model
     */
    #[JsonProperty('model')]
    public ?string $model;

    /**
     * @param array{
     *   appId?: ?string,
     *   adId?: ?string,
     *   deviceId?: ?string,
     *   platform?: ?string,
     *   manufacturer?: ?string,
     *   model?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->appId = $values['appId'] ?? null;
        $this->adId = $values['adId'] ?? null;
        $this->deviceId = $values['deviceId'] ?? null;
        $this->platform = $values['platform'] ?? null;
        $this->manufacturer = $values['manufacturer'] ?? null;
        $this->model = $values['model'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
