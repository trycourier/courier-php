<?php

declare(strict_types=1);

namespace Courier\Journeys\CancelJourneyRequest;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type ByRunIDShape = array{runID: string}
 */
final class ByRunID implements BaseModel
{
    /** @use SdkModel<ByRunIDShape> */
    use SdkModel;

    #[Required('run_id')]
    public string $runID;

    /**
     * `new ByRunID()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ByRunID::with(runID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ByRunID)->withRunID(...)
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
    public static function with(string $runID): self
    {
        $self = new self;

        $self['runID'] = $runID;

        return $self;
    }

    public function withRunID(string $runID): self
    {
        $self = clone $this;
        $self['runID'] = $runID;

        return $self;
    }
}
