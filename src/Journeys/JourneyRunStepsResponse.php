<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Every step of a Journey run. Not paginated.
 *
 * @phpstan-import-type JourneyRunStepShape from \Courier\Journeys\JourneyRunStep
 *
 * @phpstan-type JourneyRunStepsResponseShape = array{
 *   steps: list<JourneyRunStep|JourneyRunStepShape>
 * }
 */
final class JourneyRunStepsResponse implements BaseModel
{
    /** @use SdkModel<JourneyRunStepsResponseShape> */
    use SdkModel;

    /** @var list<JourneyRunStep> $steps */
    #[Required(list: JourneyRunStep::class)]
    public array $steps;

    /**
     * `new JourneyRunStepsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneyRunStepsResponse::with(steps: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneyRunStepsResponse)->withSteps(...)
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
     * @param list<JourneyRunStep|JourneyRunStepShape> $steps
     */
    public static function with(array $steps): self
    {
        $self = new self;

        $self['steps'] = $steps;

        return $self;
    }

    /**
     * @param list<JourneyRunStep|JourneyRunStepShape> $steps
     */
    public function withSteps(array $steps): self
    {
        $self = clone $this;
        $self['steps'] = $steps;

        return $self;
    }
}
