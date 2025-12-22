<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationCancelStep\Action;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type AutomationCancelStepShape = array{
 *   action: Action|value-of<Action>, cancelationToken: string
 * }
 */
final class AutomationCancelStep implements BaseModel
{
    /** @use SdkModel<AutomationCancelStepShape> */
    use SdkModel;

    /** @var value-of<Action> $action */
    #[Required(enum: Action::class)]
    public string $action;

    #[Required('cancelation_token')]
    public string $cancelationToken;

    /**
     * `new AutomationCancelStep()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AutomationCancelStep::with(action: ..., cancelationToken: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AutomationCancelStep)->withAction(...)->withCancelationToken(...)
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
     * @param Action|value-of<Action> $action
     */
    public static function with(
        Action|string $action,
        string $cancelationToken
    ): self {
        $self = new self;

        $self['action'] = $action;
        $self['cancelationToken'] = $cancelationToken;

        return $self;
    }

    /**
     * @param Action|value-of<Action> $action
     */
    public function withAction(Action|string $action): self
    {
        $self = clone $this;
        $self['action'] = $action;

        return $self;
    }

    public function withCancelationToken(string $cancelationToken): self
    {
        $self = clone $this;
        $self['cancelationToken'] = $cancelationToken;

        return $self;
    }
}
