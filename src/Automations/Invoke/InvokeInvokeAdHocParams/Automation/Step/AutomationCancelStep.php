<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationCancelStep\Action;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type automation_cancel_step = array{
 *   action: value-of<Action>, cancelationToken: string
 * }
 */
final class AutomationCancelStep implements BaseModel
{
    /** @use SdkModel<automation_cancel_step> */
    use SdkModel;

    /** @var value-of<Action> $action */
    #[Api(enum: Action::class)]
    public string $action;

    #[Api('cancelation_token')]
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
        $obj = new self;

        $obj['action'] = $action;
        $obj->cancelationToken = $cancelationToken;

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
        $obj->cancelationToken = $cancelationToken;

        return $obj;
    }
}
