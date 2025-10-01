<?php

declare(strict_types=1);

namespace Courier\Automations\AutomationInvokeAdHocParams\Automation\Step;

use Courier\Automations\AutomationInvokeAdHocParams\Automation\Step\AutomationUpdateProfileStep\Action;
use Courier\Automations\Invoke\MergeAlgorithm;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type automation_update_profile_step = array{
 *   action: value-of<Action>,
 *   merge: value-of<MergeAlgorithm>,
 *   profile: mixed,
 *   recipientID: string,
 * }
 */
final class AutomationUpdateProfileStep implements BaseModel
{
    /** @use SdkModel<automation_update_profile_step> */
    use SdkModel;

    /** @var value-of<Action> $action */
    #[Api(enum: Action::class)]
    public string $action;

    /** @var value-of<MergeAlgorithm> $merge */
    #[Api(enum: MergeAlgorithm::class)]
    public string $merge;

    #[Api]
    public mixed $profile;

    #[Api('recipient_id')]
    public string $recipientID;

    /**
     * `new AutomationUpdateProfileStep()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AutomationUpdateProfileStep::with(
     *   action: ..., merge: ..., profile: ..., recipientID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AutomationUpdateProfileStep)
     *   ->withAction(...)
     *   ->withMerge(...)
     *   ->withProfile(...)
     *   ->withRecipientID(...)
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
     * @param MergeAlgorithm|value-of<MergeAlgorithm> $merge
     */
    public static function with(
        Action|string $action,
        MergeAlgorithm|string $merge,
        mixed $profile,
        string $recipientID,
    ): self {
        $obj = new self;

        $obj->action = $action instanceof Action ? $action->value : $action;
        $obj->merge = $merge instanceof MergeAlgorithm ? $merge->value : $merge;
        $obj->profile = $profile;
        $obj->recipientID = $recipientID;

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
     * @param MergeAlgorithm|value-of<MergeAlgorithm> $merge
     */
    public function withMerge(MergeAlgorithm|string $merge): self
    {
        $obj = clone $this;
        $obj->merge = $merge instanceof MergeAlgorithm ? $merge->value : $merge;

        return $obj;
    }

    public function withProfile(mixed $profile): self
    {
        $obj = clone $this;
        $obj->profile = $profile;

        return $obj;
    }

    public function withRecipientID(string $recipientID): self
    {
        $obj = clone $this;
        $obj->recipientID = $recipientID;

        return $obj;
    }
}
