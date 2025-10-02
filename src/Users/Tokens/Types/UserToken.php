<?php

namespace Courier\Users\Tokens\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\Union;

class UserToken extends JsonSerializableType
{
    /**
     * @var ?string $token Full body of the token. Must match token in URL.
     */
    #[JsonProperty('token')]
    public ?string $token;

    /**
     * @var value-of<ProviderKey> $providerKey
     */
    #[JsonProperty('provider_key')]
    public string $providerKey;

    /**
     * @var (
     *    string
     *   |bool
     * )|null $expiryDate ISO 8601 formatted date the token expires. Defaults to 2 months. Set to false to disable expiration.
     */
    #[JsonProperty('expiry_date'), Union('string', 'bool', 'null')]
    public string|bool|null $expiryDate;

    /**
     * @var mixed $properties Properties sent to the provider along with the token
     */
    #[JsonProperty('properties')]
    public mixed $properties;

    /**
     * @var ?Device $device Information about the device the token is associated with.
     */
    #[JsonProperty('device')]
    public ?Device $device;

    /**
     * @var ?Tracking $tracking Information about the device the token is associated with.
     */
    #[JsonProperty('tracking')]
    public ?Tracking $tracking;

    /**
     * @param array{
     *   providerKey: value-of<ProviderKey>,
     *   token?: ?string,
     *   expiryDate?: (
     *    string
     *   |bool
     * )|null,
     *   properties?: mixed,
     *   device?: ?Device,
     *   tracking?: ?Tracking,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->token = $values['token'] ?? null;
        $this->providerKey = $values['providerKey'];
        $this->expiryDate = $values['expiryDate'] ?? null;
        $this->properties = $values['properties'] ?? null;
        $this->device = $values['device'] ?? null;
        $this->tracking = $values['tracking'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
