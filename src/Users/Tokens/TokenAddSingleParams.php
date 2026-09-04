<?php

declare(strict_types=1);

namespace Courier\Users\Tokens;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Users\Tokens\TokenAddSingleParams\Device;
use Courier\Users\Tokens\TokenAddSingleParams\ProviderKey;
use Courier\Users\Tokens\TokenAddSingleParams\Tracking;

/**
 * Registers one device token for a user against a provider key, overwriting the token if it already exists. Push sends resolve tokens per user.
 *
 * @see Courier\Services\Users\TokensService::addSingle()
 *
 * @phpstan-import-type ExpiryDateVariants from \Courier\Users\Tokens\TokenAddSingleParams\ExpiryDate
 * @phpstan-import-type DeviceShape from \Courier\Users\Tokens\TokenAddSingleParams\Device
 * @phpstan-import-type ExpiryDateShape from \Courier\Users\Tokens\TokenAddSingleParams\ExpiryDate
 * @phpstan-import-type TrackingShape from \Courier\Users\Tokens\TokenAddSingleParams\Tracking
 *
 * @phpstan-type TokenAddSingleParamsShape = array{
 *   userID: string,
 *   providerKey: ProviderKey|value-of<ProviderKey>,
 *   device?: null|Device|DeviceShape,
 *   expiryDate?: ExpiryDateShape|null,
 *   properties?: mixed,
 *   tracking?: null|Tracking|TrackingShape,
 * }
 */
final class TokenAddSingleParams implements BaseModel
{
    /** @use SdkModel<TokenAddSingleParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $userID;

    /** @var value-of<ProviderKey> $providerKey */
    #[Required('provider_key', enum: ProviderKey::class)]
    public string $providerKey;

    /**
     * Information about the device the token came from.
     */
    #[Optional(nullable: true)]
    public ?Device $device;

    /**
     * When the token expires. Accepts a date, or the boolean `false` to disable expiration entirely. ISO 8601 is recommended (for example `2026-10-25T00:00:00.000Z`). A value that cannot be parsed as a date is rejected; it is not treated as "no expiration" and does not fall back to the default. `true` is not a supported value. Omit the field to use the default, which expires a token that has not been re-registered for 60 days.
     *
     * @var ExpiryDateVariants|null $expiryDate
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
     * `new TokenAddSingleParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TokenAddSingleParams::with(userID: ..., providerKey: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TokenAddSingleParams)->withUserID(...)->withProviderKey(...)
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
     * @param Device|DeviceShape|null $device
     * @param ExpiryDateShape|null $expiryDate
     * @param Tracking|TrackingShape|null $tracking
     */
    public static function with(
        string $userID,
        ProviderKey|string $providerKey,
        Device|array|null $device = null,
        string|bool|null $expiryDate = null,
        mixed $properties = null,
        Tracking|array|null $tracking = null,
    ): self {
        $self = new self;

        $self['userID'] = $userID;
        $self['providerKey'] = $providerKey;

        null !== $device && $self['device'] = $device;
        null !== $expiryDate && $self['expiryDate'] = $expiryDate;
        null !== $properties && $self['properties'] = $properties;
        null !== $tracking && $self['tracking'] = $tracking;

        return $self;
    }

    public function withUserID(string $userID): self
    {
        $self = clone $this;
        $self['userID'] = $userID;

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
     * @param Device|DeviceShape|null $device
     */
    public function withDevice(Device|array|null $device): self
    {
        $self = clone $this;
        $self['device'] = $device;

        return $self;
    }

    /**
     * When the token expires. Accepts a date, or the boolean `false` to disable expiration entirely. ISO 8601 is recommended (for example `2026-10-25T00:00:00.000Z`). A value that cannot be parsed as a date is rejected; it is not treated as "no expiration" and does not fall back to the default. `true` is not a supported value. Omit the field to use the default, which expires a token that has not been re-registered for 60 days.
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
     * @param Tracking|TrackingShape|null $tracking
     */
    public function withTracking(Tracking|array|null $tracking): self
    {
        $self = clone $this;
        $self['tracking'] = $tracking;

        return $self;
    }
}
