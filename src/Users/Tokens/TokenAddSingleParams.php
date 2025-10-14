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
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new TokenAddSingleParams); // set properties as needed
 * $client->users.tokens->addSingle(...$params->toArray());
 * ```
 * Adds a single token to a user and overwrites a matching existing token.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->users.tokens->addSingle(...$params->toArray());`
 *
 * @see Courier\Users\Tokens->addSingle
 *
 * @phpstan-type token_add_single_params = array{
 *   userID: string,
 *   providerKey: ProviderKey|value-of<ProviderKey>,
 *   token?: string|null,
 *   device?: Device|null,
 *   expiryDate?: string|bool|null,
 *   properties?: mixed,
 *   tracking?: Tracking|null,
 * }
 */
final class TokenAddSingleParams implements BaseModel
{
    /** @use SdkModel<token_add_single_params> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $userID;

    /** @var value-of<ProviderKey> $providerKey */
    #[Api('provider_key', enum: ProviderKey::class)]
    public string $providerKey;

    /**
     * Full body of the token. Must match token in URL.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $token;

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
     */
    public static function with(
        string $userID,
        ProviderKey|string $providerKey,
        ?string $token = null,
        ?Device $device = null,
        string|bool|null $expiryDate = null,
        mixed $properties = null,
        ?Tracking $tracking = null,
    ): self {
        $obj = new self;

        $obj->userID = $userID;
        $obj['providerKey'] = $providerKey;

        null !== $token && $obj->token = $token;
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
     * @param ProviderKey|value-of<ProviderKey> $providerKey
     */
    public function withProviderKey(ProviderKey|string $providerKey): self
    {
        $obj = clone $this;
        $obj['providerKey'] = $providerKey;

        return $obj;
    }

    /**
     * Full body of the token. Must match token in URL.
     */
    public function withToken(?string $token): self
    {
        $obj = clone $this;
        $obj->token = $token;

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
