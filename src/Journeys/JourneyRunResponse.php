<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * A single Journey run.
 *
 * @phpstan-import-type JourneyRunShape from \Courier\Journeys\JourneyRun
 *
 * @phpstan-type JourneyRunResponseShape = array{run: JourneyRun|JourneyRunShape}
 */
final class JourneyRunResponse implements BaseModel
{
    /** @use SdkModel<JourneyRunResponseShape> */
    use SdkModel;

    /**
     * One run of a Journey. `status` and `created_at` are absent on a small number of legacy runs stored without them.
     */
    #[Required]
    public JourneyRun $run;

    /**
     * `new JourneyRunResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneyRunResponse::with(run: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneyRunResponse)->withRun(...)
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
     * @param JourneyRun|JourneyRunShape $run
     */
    public static function with(JourneyRun|array $run): self
    {
        $self = new self;

        $self['run'] = $run;

        return $self;
    }

    /**
     * One run of a Journey. `status` and `created_at` are absent on a small number of legacy runs stored without them.
     *
     * @param JourneyRun|JourneyRunShape $run
     */
    public function withRun(JourneyRun|array $run): self
    {
        $self = clone $this;
        $self['run'] = $run;

        return $self;
    }
}
