<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationFetchDataStep\Action;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationFetchDataStep\MergeStrategy;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationFetchDataStep\Webhook;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationFetchDataStep\Webhook\Method;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type AutomationFetchDataStepShape = array{
 *   action: value-of<Action>,
 *   webhook: Webhook,
 *   merge_strategy?: value-of<MergeStrategy>|null,
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

    /** @var value-of<MergeStrategy>|null $merge_strategy */
    #[Api(enum: MergeStrategy::class, nullable: true, optional: true)]
    public ?string $merge_strategy;

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
     * @param Webhook|array{
     *   method: value-of<Method>,
     *   url: string,
     *   body?: string|null,
     *   headers?: array<string,string>|null,
     * } $webhook
     * @param MergeStrategy|value-of<MergeStrategy>|null $merge_strategy
     */
    public static function with(
        Action|string $action,
        Webhook|array $webhook,
        MergeStrategy|string|null $merge_strategy = null,
    ): self {
        $obj = new self;

        $obj['action'] = $action;
        $obj['webhook'] = $webhook;

        null !== $merge_strategy && $obj['merge_strategy'] = $merge_strategy;

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
     * @param Webhook|array{
     *   method: value-of<Method>,
     *   url: string,
     *   body?: string|null,
     *   headers?: array<string,string>|null,
     * } $webhook
     */
    public function withWebhook(Webhook|array $webhook): self
    {
        $obj = clone $this;
        $obj['webhook'] = $webhook;

        return $obj;
    }

    /**
     * @param MergeStrategy|value-of<MergeStrategy>|null $mergeStrategy
     */
    public function withMergeStrategy(
        MergeStrategy|string|null $mergeStrategy
    ): self {
        $obj = clone $this;
        $obj['merge_strategy'] = $mergeStrategy;

        return $obj;
    }
}
