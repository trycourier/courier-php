<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationFetchDataStep\Action;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationFetchDataStep\MergeStrategy;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationFetchDataStep\Webhook;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type AutomationFetchDataStepShape = array{
 *   action: value-of<Action>,
 *   webhook: Webhook,
 *   mergeStrategy?: value-of<MergeStrategy>|null,
 * }
 */
final class AutomationFetchDataStep implements BaseModel
{
    /** @use SdkModel<AutomationFetchDataStepShape> */
    use SdkModel;

    /** @var value-of<Action> $action */
    #[Api(enum: Action::class)]
    public string $action;

    #[Api]
    public Webhook $webhook;

    /** @var value-of<MergeStrategy>|null $mergeStrategy */
    #[Api(
        'merge_strategy',
        enum: MergeStrategy::class,
        nullable: true,
        optional: true
    )]
    public ?string $mergeStrategy;

    /**
     * `new AutomationFetchDataStep()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AutomationFetchDataStep::with(action: ..., webhook: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AutomationFetchDataStep)->withAction(...)->withWebhook(...)
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
     * @param MergeStrategy|value-of<MergeStrategy>|null $mergeStrategy
     */
    public static function with(
        Action|string $action,
        Webhook $webhook,
        MergeStrategy|string|null $mergeStrategy = null,
    ): self {
        $obj = new self;

        $obj['action'] = $action;
        $obj->webhook = $webhook;

        null !== $mergeStrategy && $obj['mergeStrategy'] = $mergeStrategy;

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

    public function withWebhook(Webhook $webhook): self
    {
        $obj = clone $this;
        $obj->webhook = $webhook;

        return $obj;
    }

    /**
     * @param MergeStrategy|value-of<MergeStrategy>|null $mergeStrategy
     */
    public function withMergeStrategy(
        MergeStrategy|string|null $mergeStrategy
    ): self {
        $obj = clone $this;
        $obj['mergeStrategy'] = $mergeStrategy;

        return $obj;
    }
}
