<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationUpdateProfileStep\Action;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationUpdateProfileStep\Merge;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type AutomationUpdateProfileStepShape = array{
 *   action: Action|value-of<Action>,
 *   profile: array<string,mixed>,
 *   merge?: null|Merge|value-of<Merge>,
 *   recipientID?: string|null,
 * }
 */
final class AutomationUpdateProfileStep implements BaseModel
{
    /** @use SdkModel<AutomationUpdateProfileStepShape> */
    use SdkModel;

    /** @var value-of<Action> $action */
    #[Required(enum: Action::class)]
    public string $action;

    /** @var array<string,mixed> $profile */
    #[Required(map: 'mixed')]
    public array $profile;

    /** @var value-of<Merge>|null $merge */
    #[Optional(enum: Merge::class, nullable: true)]
    public ?string $merge;

    #[Optional('recipient_id', nullable: true)]
    public ?string $recipientID;

    /**
     * `new AutomationUpdateProfileStep()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AutomationUpdateProfileStep::with(action: ..., profile: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AutomationUpdateProfileStep)->withAction(...)->withProfile(...)
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
     * @param array<string,mixed> $profile
     * @param Merge|value-of<Merge>|null $merge
     */
    public static function with(
        Action|string $action,
        array $profile,
        Merge|string|null $merge = null,
        ?string $recipientID = null,
    ): self {
        $self = new self;

        $self['action'] = $action;
        $self['profile'] = $profile;

        null !== $merge && $self['merge'] = $merge;
        null !== $recipientID && $self['recipientID'] = $recipientID;

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

    /**
     * @param array<string,mixed> $profile
     */
    public function withProfile(array $profile): self
    {
        $self = clone $this;
        $self['profile'] = $profile;

        return $self;
    }

    /**
     * @param Merge|value-of<Merge>|null $merge
     */
    public function withMerge(Merge|string|null $merge): self
    {
        $self = clone $this;
        $self['merge'] = $merge;

        return $self;
    }

    public function withRecipientID(?string $recipientID): self
    {
        $self = clone $this;
        $self['recipientID'] = $recipientID;

        return $self;
    }
}
