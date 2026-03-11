<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type JourneysInvokeResponseShape = array{runID: string}
 */
final class JourneysInvokeResponse implements BaseModel
{
    /** @use SdkModel<JourneysInvokeResponseShape> */
    use SdkModel;

    /**
     * A unique identifier for the journey run that was created.
     */
    #[Required('runId')]
    public string $runID;

    /**
     * `new JourneysInvokeResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneysInvokeResponse::with(runID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneysInvokeResponse)->withRunID(...)
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

    /**
     * A unique identifier for the journey run that was created.
     */
    public function withRunID(string $runID): self
    {
        $self = clone $this;
        $self['runID'] = $runID;

        return $self;
    }
}
