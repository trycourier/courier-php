<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationCancelStep\Action;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type AutomationCancelStepShape = array{
 *   action: value-of<Action>, cancelation_token: string
 * }
 */
final class AutomationCancelStep implements BaseModel
{
    /** @use SdkModel<AutomationCancelStepShape> */
    use SdkModel;

    /** @var value-of<Action> $action */
    #[Required(enum: Action::class)]
    public string $action;

    #[Required]
    public string $cancelation_token;

    /**
     * `new AutomationCancelStep()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AutomationCancelStep::with(action: ..., cancelation_token: ...)
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
        string $cancelation_token
    ): self {
        $obj = new self;

        $obj['action'] = $action;
        $obj['cancelation_token'] = $cancelation_token;

        return $obj;
    }

    /**
     * @param Action|value-of<Action> $action
     */
    public function withAction(Action|string $action): self
    {
        $obj = clone $this;
        $obj['action'] = $action;

        return $obj;
    }

    public function withCancelationToken(string $cancelationToken): self
    {
        $obj = clone $this;
        $obj['cancelation_token'] = $cancelationToken;

        return $obj;
    }
}
