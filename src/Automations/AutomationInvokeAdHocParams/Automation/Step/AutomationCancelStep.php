<?php

declare(strict_types=1);

namespace Courier\Automations\AutomationInvokeAdHocParams\Automation\Step;

use Courier\Automations\AutomationInvokeAdHocParams\Automation\Step\AutomationCancelStep\Action;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type automation_cancel_step = array{
 *   if?: string|null,
 *   ref?: string|null,
 *   action: value-of<Action>,
 *   cancelationToken?: string|null,
 * }
 */
final class AutomationCancelStep implements BaseModel
{
    /** @use SdkModel<automation_cancel_step> */
    use SdkModel;

    #[Api(nullable: true, optional: true)]
    public ?string $if;

    #[Api(nullable: true, optional: true)]
    public ?string $ref;

    /** @var value-of<Action> $action */
    #[Api(enum: Action::class)]
    public string $action;

    #[Api('cancelation_token', nullable: true, optional: true)]
    public ?string $cancelationToken;

    /**
     * `new AutomationCancelStep()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AutomationCancelStep::with(action: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AutomationCancelStep)->withAction(...)
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
        ?string $if = null,
        ?string $ref = null,
        ?string $cancelationToken = null,
    ): self {
        $obj = new self;

        $obj->action = $action instanceof Action ? $action->value : $action;

        null !== $if && $obj->if = $if;
        null !== $ref && $obj->ref = $ref;
        null !== $cancelationToken && $obj->cancelationToken = $cancelationToken;

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

    public function withCancelationToken(?string $cancelationToken): self
    {
        $obj = clone $this;
        $obj->cancelationToken = $cancelationToken;

        return $obj;
    }
}
