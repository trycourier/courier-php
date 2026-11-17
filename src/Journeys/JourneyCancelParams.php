<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Cancels in-flight journey runs, either every run sharing a cancelation token or one run by id. Use it to stop a sequence when the event resolves.
 *
 * @see Courier\Services\JourneysService::cancel()
 *
 * @phpstan-type JourneyCancelParamsShape = array{
 *   cancelationToken: string|null,
 *   idempotencyKey?: string|null,
 *   xIdempotencyExpiration?: string|null,
 *   runID: string|null,
 * }
 */
final class JourneyCancelParams implements BaseModel
{
    /** @use SdkModel<JourneyCancelParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional('cancelation_token')]
    public ?string $cancelationToken;

    #[Optional]
    public ?string $idempotencyKey;

    #[Optional]
    public ?string $xIdempotencyExpiration;

    #[Optional('run_id')]
    public ?string $runID;

    /**
     * `new JourneyCancelParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneyCancelParams::with(cancelationToken: ..., runID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneyCancelParams)->withCancelationToken(...)->withRunID(...)
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
        ?string $cancelationToken = null,
        ?string $idempotencyKey = null,
        ?string $xIdempotencyExpiration = null,
        ?string $runID = null,
    ): self {
        $self = new self;

        $self['cancelationToken'] = $cancelationToken;
        $self['runID'] = $runID;

        null !== $idempotencyKey && $self['idempotencyKey'] = $idempotencyKey;
        null !== $xIdempotencyExpiration && $self['xIdempotencyExpiration'] = $xIdempotencyExpiration;

        return $self;
    }

    public function withCancelationToken(string $cancelationToken): self
    {
        $self = clone $this;
        $self['cancelationToken'] = $cancelationToken;

        return $self;
    }

    public function withIdempotencyKey(string $idempotencyKey): self
    {
        $self = clone $this;
        $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }

    public function withXIdempotencyExpiration(
        string $xIdempotencyExpiration
    ): self {
        $self = clone $this;
        $self['xIdempotencyExpiration'] = $xIdempotencyExpiration;

        return $self;
    }

    public function withRunID(string $runID): self
    {
        $self = clone $this;
        $self['runID'] = $runID;

        return $self;
    }
}
