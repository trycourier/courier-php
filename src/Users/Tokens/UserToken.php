<?php

declare(strict_types=1);

namespace Courier\Users\Tokens;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Users\Tokens\UserToken\Device;
use Courier\Users\Tokens\UserToken\ProviderKey;
use Courier\Users\Tokens\UserToken\Tracking;

/**
 * @phpstan-import-type DeviceShape from \Courier\Users\Tokens\UserToken\Device
 * @phpstan-import-type ExpiryDateShape from \Courier\Users\Tokens\UserToken\ExpiryDate
 * @phpstan-import-type TrackingShape from \Courier\Users\Tokens\UserToken\Tracking
 *
 * @phpstan-type UserTokenShape = array{
 *   token: string,
 *   providerKey: ProviderKey|value-of<ProviderKey>,
 *   device?: null|Device|DeviceShape,
 *   expiryDate?: ExpiryDateShape|null,
 *   properties?: mixed,
 *   tracking?: null|Tracking|TrackingShape,
 * }
 */
final class UserToken implements BaseModel
{
    /** @use SdkModel<UserTokenShape> */
    use SdkModel;

    /**
     * Full body of the token. Must match token in URL path parameter.
     */
    #[Required]
    public string $token;

    /** @var value-of<ProviderKey> $providerKey */
    #[Required('provider_key', enum: ProviderKey::class)]
    public string $providerKey;

    /**
     * Information about the device the token came from.
     */
    #[Optional(nullable: true)]
    public ?Device $device;

    /**
     * ISO 8601 formatted date the token expires. Defaults to 2 months. Set to false to disable expiration.
     */
    #[Optional('expiry_date', nullable: true)]
    public string|bool|null $expiryDate;

    /**
     * Properties about the token.
     */
    #[Optional]
    public mixed $properties;

    /**
     * Tracking information about the device the token came from.
     */
    #[Optional(nullable: true)]
    public ?Tracking $tracking;

    /**
     * `new UserToken()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UserToken::with(token: ..., providerKey: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UserToken)->withToken(...)->withProviderKey(...)
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
     *
     * @param ProviderKey|value-of<ProviderKey> $providerKey
     * @param DeviceShape|null $device
     * @param ExpiryDateShape|null $expiryDate
     * @param TrackingShape|null $tracking
     */
    public static function with(
        string $token,
        ProviderKey|string $providerKey,
        Device|array|null $device = null,
        string|bool|null $expiryDate = null,
        mixed $properties = null,
        Tracking|array|null $tracking = null,
    ): self {
        $self = new self;

        $self['token'] = $token;
        $self['providerKey'] = $providerKey;

        null !== $device && $self['device'] = $device;
        null !== $expiryDate && $self['expiryDate'] = $expiryDate;
        null !== $properties && $self['properties'] = $properties;
        null !== $tracking && $self['tracking'] = $tracking;

        return $self;
    }

    /**
     * Full body of the token. Must match token in URL path parameter.
     */
    public function withToken(string $token): self
    {
        $self = clone $this;
        $self['token'] = $token;

        return $self;
    }

    /**
     * @param ProviderKey|value-of<ProviderKey> $providerKey
     */
    public function withProviderKey(ProviderKey|string $providerKey): self
    {
        $self = clone $this;
        $self['providerKey'] = $providerKey;

        return $self;
    }

    /**
     * Information about the device the token came from.
     *
     * @param DeviceShape|null $device
     */
    public function withDevice(Device|array|null $device): self
    {
        $self = clone $this;
        $self['device'] = $device;

        return $self;
    }

    /**
     * ISO 8601 formatted date the token expires. Defaults to 2 months. Set to false to disable expiration.
     *
     * @param ExpiryDateShape|null $expiryDate
     */
    public function withExpiryDate(string|bool|null $expiryDate): self
    {
        $self = clone $this;
        $self['expiryDate'] = $expiryDate;

        return $self;
    }

    /**
     * Properties about the token.
     */
    public function withProperties(mixed $properties): self
    {
        $self = clone $this;
        $self['properties'] = $properties;

        return $self;
    }

    /**
     * Tracking information about the device the token came from.
     *
     * @param TrackingShape|null $tracking
     */
    public function withTracking(Tracking|array|null $tracking): self
    {
        $self = clone $this;
        $self['tracking'] = $tracking;

        return $self;
    }
}
