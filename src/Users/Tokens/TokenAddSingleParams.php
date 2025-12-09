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
 * Adds a single token to a user and overwrites a matching existing token.
 *
 * @see Courier\Services\Users\TokensService::addSingle()
 *
 * @phpstan-type TokenAddSingleParamsShape = array{
 *   userID: string,
 *   token: string,
 *   providerKey: ProviderKey|value-of<ProviderKey>,
 *   device?: null|Device|array{
 *     adID?: string|null,
 *     appID?: string|null,
 *     deviceID?: string|null,
 *     manufacturer?: string|null,
 *     model?: string|null,
 *     platform?: string|null,
 *   },
 *   expiryDate?: string|bool|null,
 *   properties?: mixed,
 *   tracking?: null|Tracking|array{
 *     ip?: string|null,
 *     lat?: string|null,
 *     long?: string|null,
 *     osVersion?: string|null,
 *   },
 * }
 */
final class TokenAddSingleParams implements BaseModel
{
    /** @use SdkModel<TokenAddSingleParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $userID;

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
     * `new TokenAddSingleParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TokenAddSingleParams::with(userID: ..., token: ..., providerKey: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TokenAddSingleParams)
     *   ->withUserID(...)
     *   ->withToken(...)
     *   ->withProviderKey(...)
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
     * @param Device|array{
     *   adID?: string|null,
     *   appID?: string|null,
     *   deviceID?: string|null,
     *   manufacturer?: string|null,
     *   model?: string|null,
     *   platform?: string|null,
     * }|null $device
     * @param Tracking|array{
     *   ip?: string|null,
     *   lat?: string|null,
     *   long?: string|null,
     *   osVersion?: string|null,
     * }|null $tracking
     */
    public static function with(
        string $userID,
        string $token,
        ProviderKey|string $providerKey,
        Device|array|null $device = null,
        string|bool|null $expiryDate = null,
        mixed $properties = null,
        Tracking|array|null $tracking = null,
    ): self {
        $self = new self;

        $self['userID'] = $userID;
        $self['token'] = $token;
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
     * @param Device|array{
     *   adID?: string|null,
     *   appID?: string|null,
     *   deviceID?: string|null,
     *   manufacturer?: string|null,
     *   model?: string|null,
     *   platform?: string|null,
     * }|null $device
     */
    public function withDevice(Device|array|null $device): self
    {
        $self = clone $this;
        $self['device'] = $device;

        return $self;
    }

    /**
     * ISO 8601 formatted date the token expires. Defaults to 2 months. Set to false to disable expiration.
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
     * @param Tracking|array{
     *   ip?: string|null,
     *   lat?: string|null,
     *   long?: string|null,
     *   osVersion?: string|null,
     * }|null $tracking
     */
    public function withTracking(Tracking|array|null $tracking): self
    {
        $self = clone $this;
        $self['tracking'] = $tracking;

        return $self;
    }
}
