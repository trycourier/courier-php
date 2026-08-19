<?php

declare(strict_types=1);

namespace Courier\Automations;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Every step of an Automation run. Not paginated.
 *
 * @phpstan-import-type AutomationRunStepShape from \Courier\Automations\AutomationRunStep
 *
 * @phpstan-type AutomationRunStepsResponseShape = array{
 *   steps: list<AutomationRunStep|AutomationRunStepShape>
 * }
 */
final class AutomationRunStepsResponse implements BaseModel
{
    /** @use SdkModel<AutomationRunStepsResponseShape> */
    use SdkModel;

    /** @var list<AutomationRunStep> $steps */
    #[Required(list: AutomationRunStep::class)]
    public array $steps;

    /**
     * `new AutomationRunStepsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AutomationRunStepsResponse::with(steps: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AutomationRunStepsResponse)->withSteps(...)
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
     * @param list<AutomationRunStep|AutomationRunStepShape> $steps
     */
    public static function with(array $steps): self
    {
        $self = new self;

        $self['steps'] = $steps;

        return $self;
    }

    /**
     * @param list<AutomationRunStep|AutomationRunStepShape> $steps
     */
    public function withSteps(array $steps): self
    {
        $self = clone $this;
        $self['steps'] = $steps;

        return $self;
    }
}
