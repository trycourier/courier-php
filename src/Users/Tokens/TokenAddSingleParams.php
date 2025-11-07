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
 *   userID: string,
 *   token: string,
 *   providerKey: ProviderKey|value-of<ProviderKey>,
 *   device?: Device|null,
 *   expiryDate?: string|bool|null,
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
    public string $userID;

    /**
     * Full body of the token. Must match token in URL path parameter.
     */
    #[Api]
    public string $token;

    /** @var value-of<ProviderKey> $providerKey */
    #[Api('provider_key', enum: ProviderKey::class)]
    public string $providerKey;

    /**
     * Information about the device the token is associated with.
     */
    #[Api(nullable: true, optional: true)]
    public ?Device $device;

    /**
     * ISO 8601 formatted date the token expires. Defaults to 2 months. Set to false to disable expiration.
     */
    #[Api('expiry_date', nullable: true, optional: true)]
    public string|bool|null $expiryDate;

    /**
     * Properties sent to the provider along with the token.
     */
    #[Api(optional: true)]
    public mixed $properties;

    /**
     * Information about the device the token is associated with.
     */
    #[Api(nullable: true, optional: true)]
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
     */
    public static function with(
        string $userID,
        string $token,
        ProviderKey|string $providerKey,
        ?Device $device = null,
        string|bool|null $expiryDate = null,
        mixed $properties = null,
        ?Tracking $tracking = null,
    ): self {
        $obj = new self;

        $obj->userID = $userID;
        $obj->token = $token;
        $obj['providerKey'] = $providerKey;

        null !== $device && $obj->device = $device;
        null !== $expiryDate && $obj->expiryDate = $expiryDate;
        null !== $properties && $obj->properties = $properties;
        null !== $tracking && $obj->tracking = $tracking;

        return $obj;
    }

    public function withUserID(string $userID): self
    {
        $obj = clone $this;
        $obj->userID = $userID;

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
        $obj['providerKey'] = $providerKey;

        return $obj;
    }

    /**
     * Information about the device the token is associated with.
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
        $obj->expiryDate = $expiryDate;

        return $obj;
    }

    /**
     * Properties sent to the provider along with the token.
     */
    public function withProperties(mixed $properties): self
    {
        $obj = clone $this;
        $obj->properties = $properties;

        return $obj;
    }

    /**
     * Information about the device the token is associated with.
     */
    public function withTracking(?Tracking $tracking): self
    {
        $obj = clone $this;
        $obj->tracking = $tracking;

        return $obj;
    }
}
