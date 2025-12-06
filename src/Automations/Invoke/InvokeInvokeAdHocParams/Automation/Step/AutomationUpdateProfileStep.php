<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationUpdateProfileStep\Action;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationUpdateProfileStep\Merge;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type AutomationUpdateProfileStepShape = array{
 *   action: value-of<Action>,
 *   profile: array<string,mixed>,
 *   merge?: value-of<Merge>|null,
 *   recipient_id?: string|null,
 * }
 */
final class AutomationUpdateProfileStep implements BaseModel
{
    /** @use SdkModel<AutomationUpdateProfileStepShape> */
    use SdkModel;

    /** @var value-of<Action> $action */
    #[Api(enum: Action::class)]
    public string $action;

    /** @var array<string,mixed> $profile */
    #[Api(map: 'mixed')]
    public array $profile;

    /** @var value-of<Merge>|null $merge */
    #[Api(enum: Merge::class, nullable: true, optional: true)]
    public ?string $merge;

    #[Api(nullable: true, optional: true)]
    public ?string $recipient_id;

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
        ?string $recipient_id = null,
    ): self {
        $obj = new self;

        $obj['action'] = $action;
        $obj['profile'] = $profile;

        null !== $merge && $obj['merge'] = $merge;
        null !== $recipient_id && $obj['recipient_id'] = $recipient_id;

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

    /**
     * @param array<string,mixed> $profile
     */
    public function withProfile(array $profile): self
    {
        $obj = clone $this;
        $obj['profile'] = $profile;

        return $obj;
    }

    /**
     * @param Merge|value-of<Merge>|null $merge
     */
    public function withMerge(Merge|string|null $merge): self
    {
        $obj = clone $this;
        $obj['merge'] = $merge;

        return $obj;
    }

    public function withRecipientID(?string $recipientID): self
    {
        $obj = clone $this;
        $obj['recipient_id'] = $recipientID;

        return $obj;
    }
}
