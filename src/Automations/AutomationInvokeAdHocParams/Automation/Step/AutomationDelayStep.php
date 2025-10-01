<?php

declare(strict_types=1);

namespace Courier\Automations\AutomationInvokeAdHocParams\Automation\Step;

use Courier\Automations\AutomationInvokeAdHocParams\Automation\Step\AutomationDelayStep\Action;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type automation_delay_step = array{
 *   if?: string|null,
 *   ref?: string|null,
 *   action: value-of<Action>,
 *   duration?: string|null,
 *   until?: string|null,
 * }
 */
final class AutomationDelayStep implements BaseModel
{
    /** @use SdkModel<automation_delay_step> */
    use SdkModel;

    #[Api(nullable: true, optional: true)]
    public ?string $if;

    #[Api(nullable: true, optional: true)]
    public ?string $ref;

    /** @var value-of<Action> $action */
    #[Api(enum: Action::class)]
    public string $action;

    /**
     * The [ISO 8601 duration](https://en.wikipedia.org/wiki/ISO_8601#Durations) string for how long to delay for.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $duration;

    /**
     * The ISO 8601 timestamp for when the delay should end.
     */
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
        ?string $if = null,
        ?string $ref = null,
        ?string $duration = null,
        ?string $until = null,
    ): self {
        $obj = new self;

        $obj->action = $action instanceof Action ? $action->value : $action;

        null !== $if && $obj->if = $if;
        null !== $ref && $obj->ref = $ref;
        null !== $duration && $obj->duration = $duration;
        null !== $until && $obj->until = $until;

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

    /**
     * The [ISO 8601 duration](https://en.wikipedia.org/wiki/ISO_8601#Durations) string for how long to delay for.
     */
    public function withDuration(?string $duration): self
    {
        $obj = clone $this;
        $obj->duration = $duration;

        return $obj;
    }

    /**
     * The ISO 8601 timestamp for when the delay should end.
     */
    public function withUntil(?string $until): self
    {
        $obj = clone $this;
        $obj->until = $until;

        return $obj;
    }
}
