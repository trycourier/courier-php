<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams\Message;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type ExpiryShape = array{
 *   expiresIn: string|int, expiresAt?: string|null
 * }
 */
final class Expiry implements BaseModel
{
    /** @use SdkModel<ExpiryShape> */
    use SdkModel;

    /**
     * Duration in ms or ISO8601 duration (e.g. P1DT4H).
     */
    #[Required('expires_in')]
    public string|int $expiresIn;

    /**
     * Epoch or ISO8601 timestamp with timezone.
     */
    #[Optional('expires_at', nullable: true)]
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

        $obj['expiresIn'] = $expiresIn;

        null !== $expiresAt && $obj['expiresAt'] = $expiresAt;

        return $obj;
    }

    /**
     * Duration in ms or ISO8601 duration (e.g. P1DT4H).
     */
    public function withExpiresIn(string|int $expiresIn): self
    {
        $obj = clone $this;
        $obj['expiresIn'] = $expiresIn;

        return $obj;
    }

    /**
     * Epoch or ISO8601 timestamp with timezone.
     */
    public function withExpiresAt(?string $expiresAt): self
    {
        $obj = clone $this;
        $obj['expiresAt'] = $expiresAt;

        return $obj;
    }
}
