<?php

declare(strict_types=1);

namespace Courier\Journeys\CancelJourneyResponse;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type TokenBranchShape = array{cancelationToken: string}
 */
final class TokenBranch implements BaseModel
{
    /** @use SdkModel<TokenBranchShape> */
    use SdkModel;

    #[Required('cancelation_token')]
    public string $cancelationToken;

    /**
     * `new TokenBranch()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TokenBranch::with(cancelationToken: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TokenBranch)->withCancelationToken(...)
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
