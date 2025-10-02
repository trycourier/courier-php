<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationThrottleStep\Action;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationThrottleStep\OnThrottle;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationThrottleStep\Scope;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type automation_throttle_step = array{
 *   if?: string|null,
 *   ref?: string|null,
 *   action: value-of<Action>,
 *   maxAllowed: int,
 *   onThrottle: OnThrottle,
 *   period: string,
 *   scope: value-of<Scope>,
 *   shouldAlert: bool,
 *   throttleKey?: string|null,
 * }
 */
final class AutomationThrottleStep implements BaseModel
{
    /** @use SdkModel<automation_throttle_step> */
    use SdkModel;

    #[Api(nullable: true, optional: true)]
    public ?string $if;

    #[Api(nullable: true, optional: true)]
    public ?string $ref;

    /** @var value-of<Action> $action */
    #[Api(enum: Action::class)]
    public string $action;

    /**
     * Maximum number of allowed notifications in that timeframe.
     */
    #[Api('max_allowed')]
    public int $maxAllowed;

    #[Api('on_throttle')]
    public OnThrottle $onThrottle;

    /**
     * Defines the throttle period which corresponds to the max_allowed. Specified as an ISO 8601 duration, https://en.wikipedia.org/wiki/ISO_8601#Durations.
     */
    #[Api]
    public string $period;

    /** @var value-of<Scope> $scope */
    #[Api(enum: Scope::class)]
    public string $scope;

    /**
     * Value must be true.
     */
    #[Api('should_alert')]
    public bool $shouldAlert;

    /**
     * If using scope=dynamic, provide the reference (e.g., refs.data.throttle_key) to the how the throttle should be identified.
     */
    #[Api('throttle_key', nullable: true, optional: true)]
    public ?string $throttleKey;

    /**
     * `new AutomationThrottleStep()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AutomationThrottleStep::with(
     *   action: ...,
     *   maxAllowed: ...,
     *   onThrottle: ...,
     *   period: ...,
     *   scope: ...,
     *   shouldAlert: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AutomationThrottleStep)
     *   ->withAction(...)
     *   ->withMaxAllowed(...)
     *   ->withOnThrottle(...)
     *   ->withPeriod(...)
     *   ->withScope(...)
     *   ->withShouldAlert(...)
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
     * @param Scope|value-of<Scope> $scope
     */
    public static function with(
        Action|string $action,
        int $maxAllowed,
        OnThrottle $onThrottle,
        string $period,
        Scope|string $scope,
        bool $shouldAlert,
        ?string $if = null,
        ?string $ref = null,
        ?string $throttleKey = null,
    ): self {
        $obj = new self;

        $obj->action = $action instanceof Action ? $action->value : $action;
        $obj->maxAllowed = $maxAllowed;
        $obj->onThrottle = $onThrottle;
        $obj->period = $period;
        $obj->scope = $scope instanceof Scope ? $scope->value : $scope;
        $obj->shouldAlert = $shouldAlert;

        null !== $if && $obj->if = $if;
        null !== $ref && $obj->ref = $ref;
        null !== $throttleKey && $obj->throttleKey = $throttleKey;

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
     * Maximum number of allowed notifications in that timeframe.
     */
    public function withMaxAllowed(int $maxAllowed): self
    {
        $obj = clone $this;
        $obj->maxAllowed = $maxAllowed;

        return $obj;
    }

    public function withOnThrottle(OnThrottle $onThrottle): self
    {
        $obj = clone $this;
        $obj->onThrottle = $onThrottle;

        return $obj;
    }

    /**
     * Defines the throttle period which corresponds to the max_allowed. Specified as an ISO 8601 duration, https://en.wikipedia.org/wiki/ISO_8601#Durations.
     */
    public function withPeriod(string $period): self
    {
        $obj = clone $this;
        $obj->period = $period;

        return $obj;
    }

    /**
     * @param Scope|value-of<Scope> $scope
     */
    public function withScope(Scope|string $scope): self
    {
        $obj = clone $this;
        $obj->scope = $scope instanceof Scope ? $scope->value : $scope;

        return $obj;
    }

    /**
     * Value must be true.
     */
    public function withShouldAlert(bool $shouldAlert): self
    {
        $obj = clone $this;
        $obj->shouldAlert = $shouldAlert;

        return $obj;
    }

    /**
     * If using scope=dynamic, provide the reference (e.g., refs.data.throttle_key) to the how the throttle should be identified.
     */
    public function withThrottleKey(?string $throttleKey): self
    {
        $obj = clone $this;
        $obj->throttleKey = $throttleKey;

        return $obj;
    }
}
