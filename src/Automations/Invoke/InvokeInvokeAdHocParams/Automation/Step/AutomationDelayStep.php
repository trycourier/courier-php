<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationDelayStep\Action;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type AutomationDelayStepShape = array{
 *   action: value-of<Action>, duration?: string|null, until?: string|null
 * }
 */
final class AutomationDelayStep implements BaseModel
{
    /** @use SdkModel<AutomationDelayStepShape> */
    use SdkModel;

    /** @var value-of<Action> $action */
    #[Api(enum: Action::class)]
    public string $action;

    #[Api(nullable: true, optional: true)]
    public ?string $duration;

    #[Api(nullable: true, optional: true)]
    public ?string $until;

    /**
     * `new AutomationDelayStep()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AutomationDelayStep::with(action: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AutomationDelayStep)->withAction(...)
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
        ?string $duration = null,
        ?string $until = null
    ): self {
        $obj = new self;

        $obj['action'] = $action;

        null !== $duration && $obj->duration = $duration;
        null !== $until && $obj->until = $until;

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

    public function withDuration(?string $duration): self
    {
        $obj = clone $this;
        $obj->duration = $duration;

        return $obj;
    }

    public function withUntil(?string $until): self
    {
        $obj = clone $this;
        $obj->until = $until;

        return $obj;
    }
}
