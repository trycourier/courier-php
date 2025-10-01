<?php

declare(strict_types=1);

namespace Courier\Automations\AutomationInvokeAdHocParams\Automation\Step;

use Courier\Automations\AutomationInvokeAdHocParams\Automation\Step\AutomationInvokeStep\Action;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type automation_invoke_step = array{
 *   if?: string|null,
 *   ref?: string|null,
 *   action: value-of<Action>,
 *   template: string,
 * }
 */
final class AutomationInvokeStep implements BaseModel
{
    /** @use SdkModel<automation_invoke_step> */
    use SdkModel;

    #[Api(nullable: true, optional: true)]
    public ?string $if;

    #[Api(nullable: true, optional: true)]
    public ?string $ref;

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
    public static function with(
        Action|string $action,
        string $template,
        ?string $if = null,
        ?string $ref = null,
    ): self {
        $obj = new self;

        $obj->action = $action instanceof Action ? $action->value : $action;
        $obj->template = $template;

        null !== $if && $obj->if = $if;
        null !== $ref && $obj->ref = $ref;

        return $obj;
    }

    public function withIf(?string $if): self
    {
        $obj = clone $this;
        $obj->if = $if;

        return $obj;
    }

    public function withRef(?string $ref): self
    {
        $obj = clone $this;
        $obj->ref = $ref;

        return $obj;
    }

    /**
     * @param Action|value-of<Action> $action
     */
    public function withAction(Action|string $action): self
    {
        $obj = clone $this;
        $obj->action = $action instanceof Action ? $action->value : $action;

        return $obj;
    }

    public function withTemplate(string $template): self
    {
        $obj = clone $this;
        $obj->template = $template;

        return $obj;
    }
}
