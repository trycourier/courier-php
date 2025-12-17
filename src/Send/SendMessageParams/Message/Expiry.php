<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams\Message;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ExpiresInShape from \Courier\Send\SendMessageParams\Message\Expiry\ExpiresIn
 *
 * @phpstan-type ExpiryShape = array{
 *   expiresIn: ExpiresInShape, expiresAt?: string|null
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
     *
     * @param ExpiresInShape $expiresIn
     */
    public static function with(
        string|int $expiresIn,
        ?string $expiresAt = null
    ): self {
        $self = new self;

        $self['expiresIn'] = $expiresIn;

        null !== $expiresAt && $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * Duration in ms or ISO8601 duration (e.g. P1DT4H).
     *
     * @param ExpiresInShape $expiresIn
     */
    public function withExpiresIn(string|int $expiresIn): self
    {
        $self = clone $this;
        $self['expiresIn'] = $expiresIn;

        return $self;
    }

    /**
     * Epoch or ISO8601 timestamp with timezone.
     */
    public function withExpiresAt(?string $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }
}
