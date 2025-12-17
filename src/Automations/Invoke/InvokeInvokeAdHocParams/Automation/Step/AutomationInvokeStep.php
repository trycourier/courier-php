<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationInvokeStep\Action;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type AutomationInvokeStepShape = array{
 *   action: Action|value-of<Action>, template: string
 * }
 */
final class AutomationInvokeStep implements BaseModel
{
    /** @use SdkModel<AutomationInvokeStepShape> */
    use SdkModel;

    /** @var value-of<Action> $action */
    #[Required(enum: Action::class)]
    public string $action;

    #[Required]
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
        $self = new self;

        $self['action'] = $action;
        $self['template'] = $template;

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

    public function withTemplate(string $template): self
    {
        $self = clone $this;
        $self['template'] = $template;

        return $self;
    }
}
