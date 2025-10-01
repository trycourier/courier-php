<?php

declare(strict_types=1);

namespace Courier\Users\Tokens;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Users\Tokens\UserToken\Device;
use Courier\Users\Tokens\UserToken\ProviderKey;
use Courier\Users\Tokens\UserToken\Tracking;

/**
 * @phpstan-type user_token = array{
 *   providerKey: value-of<ProviderKey>,
 *   token?: string|null,
 *   device?: Device|null,
 *   expiryDate?: string|bool|null,
 *   properties?: mixed,
 *   tracking?: Tracking|null,
 * }
 */
final class UserToken implements BaseModel
{
    /** @use SdkModel<user_token> */
    use SdkModel;

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
     * `new UserToken()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UserToken::with(providerKey: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UserToken)->withProviderKey(...)
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
        ProviderKey|string $providerKey,
        ?string $token = null,
        ?Device $device = null,
        string|bool|null $expiryDate = null,
        mixed $properties = null,
        ?Tracking $tracking = null,
    ): self {
        $obj = new self;

        $obj->providerKey = $providerKey instanceof ProviderKey ? $providerKey->value : $providerKey;

        null !== $token && $obj->token = $token;
        null !== $device && $obj->device = $device;
        null !== $expiryDate && $obj->expiryDate = $expiryDate;
        null !== $properties && $obj->properties = $properties;
        null !== $tracking && $obj->tracking = $tracking;

        return $obj;
    }

    /**
     * @param ProviderKey|value-of<ProviderKey> $providerKey
     */
    public function withProviderKey(ProviderKey|string $providerKey): self
    {
        $obj = clone $this;
        $obj->providerKey = $providerKey instanceof ProviderKey ? $providerKey->value : $providerKey;

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
