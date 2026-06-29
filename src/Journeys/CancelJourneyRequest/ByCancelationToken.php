<?php

declare(strict_types=1);

namespace Courier\Journeys\CancelJourneyRequest;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type ByCancelationTokenShape = array{cancelationToken: string}
 */
final class ByCancelationToken implements BaseModel
{
    /** @use SdkModel<ByCancelationTokenShape> */
    use SdkModel;

    #[Required('cancelation_token')]
    public string $cancelationToken;

    /**
     * `new ByCancelationToken()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ByCancelationToken::with(cancelationToken: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ByCancelationToken)->withCancelationToken(...)
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
    public static function with(string $cancelationToken): self
    {
        $self = new self;

        $self['cancelationToken'] = $cancelationToken;

        return $self;
    }

    public function withCancelationToken(string $cancelationToken): self
    {
        $self = clone $this;
        $self['cancelationToken'] = $cancelationToken;

        return $self;
    }
}
