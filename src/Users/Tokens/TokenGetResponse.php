<?php

declare(strict_types=1);

namespace Courier\Users\Tokens;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Users\Tokens\TokenGetResponse\Status;
use Courier\Users\Tokens\UserToken\Device;
use Courier\Users\Tokens\UserToken\ProviderKey;
use Courier\Users\Tokens\UserToken\Tracking;

/**
 * @phpstan-type TokenGetResponseShape = array{
 *   token: string,
 *   providerKey: value-of<ProviderKey>,
 *   device?: Device|null,
 *   expiryDate?: string|bool|null,
 *   properties?: mixed,
 *   tracking?: Tracking|null,
 *   status?: value-of<Status>|null,
 *   statusReason?: string|null,
 * }
 */
final class TokenGetResponse implements BaseModel
{
    /** @use SdkModel<TokenGetResponseShape> */
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

    /** @var value-of<Status>|null $status */
    #[Optional(enum: Status::class, nullable: true)]
    public ?string $status;

    /**
     * The reason for the token status.
     */
    #[Optional('status_reason', nullable: true)]
    public ?string $statusReason;

    /**
     * `new TokenGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TokenGetResponse::with(token: ..., providerKey: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TokenGetResponse)->withToken(...)->withProviderKey(...)
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
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        string $token,
        ProviderKey|string $providerKey,
        Device|array|null $device = null,
        string|bool|null $expiryDate = null,
        mixed $properties = null,
        Tracking|array|null $tracking = null,
        Status|string|null $status = null,
        ?string $statusReason = null,
    ): self {
        $obj = new self;

        $obj['token'] = $token;
        $obj['providerKey'] = $providerKey;

        null !== $device && $obj['device'] = $device;
        null !== $expiryDate && $obj['expiryDate'] = $expiryDate;
        null !== $properties && $obj['properties'] = $properties;
        null !== $tracking && $obj['tracking'] = $tracking;
        null !== $status && $obj['status'] = $status;
        null !== $statusReason && $obj['statusReason'] = $statusReason;

        return $obj;
    }

    /**
     * Full body of the token. Must match token in URL path parameter.
     */
    public function withToken(string $token): self
    {
        $obj = clone $this;
        $obj['token'] = $token;

        return $obj;
    }

    /**
     * @param ProviderKey|value-of<ProviderKey> $providerKey
     */
    public function withProviderKey(ProviderKey|string $providerKey): self
    {
        $obj = clone $this;
        $obj['providerKey'] = $providerKey;

        return $obj;
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
        $obj = clone $this;
        $obj['device'] = $device;

        return $obj;
    }

    /**
     * ISO 8601 formatted date the token expires. Defaults to 2 months. Set to false to disable expiration.
     */
    public function withExpiryDate(string|bool|null $expiryDate): self
    {
        $obj = clone $this;
        $obj['expiryDate'] = $expiryDate;

        return $obj;
    }

    /**
     * Properties about the token.
     */
    public function withProperties(mixed $properties): self
    {
        $obj = clone $this;
        $obj['properties'] = $properties;

        return $obj;
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
        $obj = clone $this;
        $obj['tracking'] = $tracking;

        return $obj;
    }

    /**
     * @param Status|value-of<Status>|null $status
     */
    public function withStatus(Status|string|null $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }

    /**
     * The reason for the token status.
     */
    public function withStatusReason(?string $statusReason): self
    {
        $obj = clone $this;
        $obj['statusReason'] = $statusReason;

        return $obj;
    }
}
