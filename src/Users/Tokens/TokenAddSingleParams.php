<?php

declare(strict_types=1);

namespace Courier\Users\Tokens;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Users\Tokens\TokenAddSingleParams\Device;
use Courier\Users\Tokens\TokenAddSingleParams\ProviderKey;
use Courier\Users\Tokens\TokenAddSingleParams\Tracking;

/**
 * Adds a single token to a user and overwrites a matching existing token.
 *
 * @see Courier\Users\Tokens->addSingle
 *
 * @phpstan-type TokenAddSingleParamsShape = array{
 *   user_id: string,
 *   token: string,
 *   provider_key: ProviderKey|value-of<ProviderKey>,
 *   device?: Device|null,
 *   expiry_date?: string|bool|null,
 *   properties?: mixed,
 *   tracking?: Tracking|null,
 * }
 */
final class TokenAddSingleParams implements BaseModel
{
    /** @use SdkModel<TokenAddSingleParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $user_id;

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

    /**
     * `new TokenAddSingleParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TokenAddSingleParams::with(user_id: ..., token: ..., provider_key: ...)
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
     * @param ProviderKey|value-of<ProviderKey> $provider_key
     */
    public static function with(
        string $user_id,
        string $token,
        ProviderKey|string $provider_key,
        ?Device $device = null,
        string|bool|null $expiry_date = null,
        mixed $properties = null,
        ?Tracking $tracking = null,
    ): self {
        $obj = new self;

        $obj->user_id = $user_id;
        $obj->token = $token;
        $obj['provider_key'] = $provider_key;

        null !== $device && $obj->device = $device;
        null !== $expiry_date && $obj->expiry_date = $expiry_date;
        null !== $properties && $obj->properties = $properties;
        null !== $tracking && $obj->tracking = $tracking;

        return $obj;
    }

    public function withUserID(string $userID): self
    {
        $obj = clone $this;
        $obj->user_id = $userID;

        return $obj;
    }

    /**
     * Full body of the token. Must match token in URL path parameter.
     */
    public function withToken(string $token): self
    {
        $obj = clone $this;
        $obj->token = $token;

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
     */
    public function withDevice(?Device $device): self
    {
        $obj = clone $this;
        $obj->device = $device;

        return $obj;
    }

    /**
     * ISO 8601 formatted date the token expires. Defaults to 2 months. Set to false to disable expiration.
     */
    public function withExpiryDate(string|bool|null $expiryDate): self
    {
        $obj = clone $this;
        $obj->expiry_date = $expiryDate;

        return $obj;
    }

    /**
     * Properties about the token.
     */
    public function withProperties(mixed $properties): self
    {
        $obj = clone $this;
        $obj->properties = $properties;

        return $obj;
    }

    /**
     * Tracking information about the device the token came from.
     */
    public function withTracking(?Tracking $tracking): self
    {
        $obj = clone $this;
        $obj->tracking = $tracking;

        return $obj;
    }
}
