<?php

declare(strict_types=1);

namespace Courier\Users\Tokens;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkResponse;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\Contracts\ResponseConverter;
use Courier\Users\Tokens\TokenGetResponse\Status;
use Courier\Users\Tokens\UserToken\Device;
use Courier\Users\Tokens\UserToken\ProviderKey;
use Courier\Users\Tokens\UserToken\Tracking;

/**
 * @phpstan-type TokenGetResponseShape = array{
 *   token: string,
 *   provider_key: value-of<ProviderKey>,
 *   device?: Device|null,
 *   expiry_date?: string|bool|null,
 *   properties?: mixed,
 *   tracking?: Tracking|null,
 *   status?: value-of<Status>|null,
 *   status_reason?: string|null,
 * }
 */
final class TokenGetResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<TokenGetResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * Full body of the token. Must match token in URL path parameter.
     */
    #[Api]
    public string $token;

    /** @var value-of<ProviderKey> $provider_key */
    #[Api(enum: ProviderKey::class)]
    public string $provider_key;

    /**
     * Information about the device the token came from.
     */
    #[Api(nullable: true, optional: true)]
    public ?Device $device;

    /**
     * ISO 8601 formatted date the token expires. Defaults to 2 months. Set to false to disable expiration.
     */
    #[Api(nullable: true, optional: true)]
    public string|bool|null $expiry_date;

    /**
     * Properties about the token.
     */
    #[Api(optional: true)]
    public mixed $properties;

    /**
     * Tracking information about the device the token came from.
     */
    #[Api(nullable: true, optional: true)]
    public ?Tracking $tracking;

    /** @var value-of<Status>|null $status */
    #[Api(enum: Status::class, nullable: true, optional: true)]
    public ?string $status;

    /**
     * The reason for the token status.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $status_reason;

    /**
     * `new TokenGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TokenGetResponse::with(token: ..., provider_key: ...)
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
     * @param ProviderKey|value-of<ProviderKey> $provider_key
     * @param Device|array{
     *   ad_id?: string|null,
     *   app_id?: string|null,
     *   device_id?: string|null,
     *   manufacturer?: string|null,
     *   model?: string|null,
     *   platform?: string|null,
     * }|null $device
     * @param Tracking|array{
     *   ip?: string|null,
     *   lat?: string|null,
     *   long?: string|null,
     *   os_version?: string|null,
     * }|null $tracking
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        string $token,
        ProviderKey|string $provider_key,
        Device|array|null $device = null,
        string|bool|null $expiry_date = null,
        mixed $properties = null,
        Tracking|array|null $tracking = null,
        Status|string|null $status = null,
        ?string $status_reason = null,
    ): self {
        $obj = new self;

        $obj['token'] = $token;
        $obj['provider_key'] = $provider_key;

        null !== $device && $obj['device'] = $device;
        null !== $expiry_date && $obj['expiry_date'] = $expiry_date;
        null !== $properties && $obj['properties'] = $properties;
        null !== $tracking && $obj['tracking'] = $tracking;
        null !== $status && $obj['status'] = $status;
        null !== $status_reason && $obj['status_reason'] = $status_reason;

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
        $obj['provider_key'] = $providerKey;

        return $obj;
    }

    /**
     * Information about the device the token came from.
     *
     * @param Device|array{
     *   ad_id?: string|null,
     *   app_id?: string|null,
     *   device_id?: string|null,
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
        $obj['expiry_date'] = $expiryDate;

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
     *   os_version?: string|null,
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
        $obj['status_reason'] = $statusReason;

        return $obj;
    }
}
