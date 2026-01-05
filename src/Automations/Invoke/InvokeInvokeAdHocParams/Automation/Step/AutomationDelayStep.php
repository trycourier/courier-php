<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationDelayStep\Action;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type AutomationDelayStepShape = array{
 *   action: Action|value-of<Action>, duration?: string|null, until?: string|null
 * }
 */
final class AutomationDelayStep implements BaseModel
{
    /** @use SdkModel<AutomationDelayStepShape> */
    use SdkModel;

    /** @var value-of<Action> $action */
    #[Required(enum: Action::class)]
    public string $action;

    #[Optional(nullable: true)]
    public ?string $duration;

    #[Optional(nullable: true)]
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
        $self = new self;

        $self['action'] = $action;

        null !== $duration && $self['duration'] = $duration;
        null !== $until && $self['until'] = $until;

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

    public function withDuration(?string $duration): self
    {
        $self = clone $this;
        $self['duration'] = $duration;

        return $self;
    }

    public function withUntil(?string $until): self
    {
        $self = clone $this;
        $self['until'] = $until;

        return $self;
    }
}
