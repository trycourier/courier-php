<?php

declare(strict_types=1);

namespace Courier\Send\BaseMessage;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * "Expiry allows you to set an absolute or relative time in which a message expires.
 * Note: This is only valid for the Courier Inbox channel as of 12-08-2022.".
 *
 * @phpstan-type expiry_alias = array{
 *   expiresIn: string|int, expiresAt?: string|null
 * }
 */
final class Expiry implements BaseModel
{
    /** @use SdkModel<expiry_alias> */
    use SdkModel;

    /**
     * A duration in the form of milliseconds or an ISO8601 Duration format (i.e. P1DT4H).
     */
    #[Api('expires_in')]
    public string|int $expiresIn;

    /**
     * An epoch timestamp or ISO8601 timestamp with timezone `(YYYY-MM-DDThh:mm:ss.sTZD)` that describes the time in which a message expires.
     */
    #[Api('expires_at', nullable: true, optional: true)]
    public ?string $expiresAt;

    /**
     * `new Expiry()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Expiry::with(expiresIn: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Expiry)->withExpiresIn(...)
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
     */
    public static function with(
        string|int $expiresIn,
        ?string $expiresAt = null
    ): self {
        $obj = new self;

        $obj->expiresIn = $expiresIn;

        null !== $expiresAt && $obj->expiresAt = $expiresAt;

        return $obj;
    }

    /**
     * A duration in the form of milliseconds or an ISO8601 Duration format (i.e. P1DT4H).
     */
    public function withExpiresIn(string|int $expiresIn): self
    {
        $obj = clone $this;
        $obj->expiresIn = $expiresIn;

        return $obj;
    }

    /**
     * An epoch timestamp or ISO8601 timestamp with timezone `(YYYY-MM-DDThh:mm:ss.sTZD)` that describes the time in which a message expires.
     */
    public function withExpiresAt(?string $expiresAt): self
    {
        $obj = clone $this;
        $obj->expiresAt = $expiresAt;

        return $obj;
    }
}
