<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationInvokeStep\Action;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type AutomationInvokeStepShape = array{
 *   action: value-of<Action>, template: string
 * }
 */
final class AutomationInvokeStep implements BaseModel
{
    /** @use SdkModel<AutomationInvokeStepShape> */
    use SdkModel;

    /** @var value-of<Action> $action */
    #[Api(enum: Action::class)]
    public string $action;

    #[Api]
    public string $template;

    /**
     * `new AutomationInvokeStep()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AutomationInvokeStep::with(action: ..., template: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AutomationInvokeStep)->withAction(...)->withTemplate(...)
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
    public static function with(Action|string $action, string $template): self
    {
        $obj = new self;

        $obj['action'] = $action;
        $obj->template = $template;

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

    public function withTemplate(string $template): self
    {
        $obj = clone $this;
        $obj->template = $template;

        return $obj;
    }
}
