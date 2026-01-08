<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type StepVariants from \Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step
 * @phpstan-import-type StepShape from \Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step
 *
 * @phpstan-type AutomationShape = array{
 *   steps: list<StepShape>, cancelationToken?: string|null
 * }
 */
final class Automation implements BaseModel
{
    /** @use SdkModel<AutomationShape> */
    use SdkModel;

    /** @var list<StepVariants> $steps */
    #[Required(list: Step::class)]
    public array $steps;

    #[Optional('cancelation_token', nullable: true)]
    public ?string $cancelationToken;

    /**
     * `new Automation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Automation::with(steps: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Automation)->withSteps(...)
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
     * @param list<StepShape> $steps
     */
    public static function with(
        array $steps,
        ?string $cancelationToken = null
    ): self {
        $self = new self;

        $self['steps'] = $steps;

        null !== $cancelationToken && $self['cancelationToken'] = $cancelationToken;

        return $self;
    }

    /**
     * @param list<StepShape> $steps
     */
    public function withSteps(array $steps): self
    {
        $self = clone $this;
        $self['steps'] = $steps;

        return $self;
    }

    public function withCancelationToken(?string $cancelationToken): self
    {
        $self = clone $this;
        $self['cancelationToken'] = $cancelationToken;

        return $self;
    }
}
