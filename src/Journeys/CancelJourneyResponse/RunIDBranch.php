<?php

declare(strict_types=1);

namespace Courier\Journeys\CancelJourneyResponse;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type RunIDBranchShape = array{runID: string, status: string}
 */
final class RunIDBranch implements BaseModel
{
    /** @use SdkModel<RunIDBranchShape> */
    use SdkModel;

    #[Required('run_id')]
    public string $runID;

    /**
     * The run's resulting status. `CANCELED` when the run was active and we canceled it; `PROCESSED` or `ERROR` when the run had already finished and was left untouched; `CANCELED` for an already-canceled run.
     */
    #[Required]
    public string $status;

    /**
     * `new RunIDBranch()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RunIDBranch::with(runID: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RunIDBranch)->withRunID(...)->withStatus(...)
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
    public static function with(string $runID, string $status): self
    {
        $self = new self;

        $self['runID'] = $runID;
        $self['status'] = $status;

        return $self;
    }

    public function withRunID(string $runID): self
    {
        $self = clone $this;
        $self['runID'] = $runID;

        return $self;
    }

    /**
     * The run's resulting status. `CANCELED` when the run was active and we canceled it; `PROCESSED` or `ERROR` when the run had already finished and was left untouched; `CANCELED` for an already-canceled run.
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
