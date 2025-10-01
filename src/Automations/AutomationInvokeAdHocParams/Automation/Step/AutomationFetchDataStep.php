<?php

declare(strict_types=1);

namespace Courier\Automations\AutomationInvokeAdHocParams\Automation\Step;

use Courier\Automations\AutomationInvokeAdHocParams\Automation\Step\AutomationFetchDataStep\Action;
use Courier\Automations\AutomationInvokeAdHocParams\Automation\Step\AutomationFetchDataStep\Webhook;
use Courier\Automations\Invoke\MergeAlgorithm;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type automation_fetch_data_step = array{
 *   if?: string|null,
 *   ref?: string|null,
 *   action: value-of<Action>,
 *   mergeStrategy: value-of<MergeAlgorithm>,
 *   webhook: Webhook,
 *   idempotencyExpiry?: string|null,
 *   idempotencyKey?: string|null,
 * }
 */
final class AutomationFetchDataStep implements BaseModel
{
    /** @use SdkModel<automation_fetch_data_step> */
    use SdkModel;

    #[Api(nullable: true, optional: true)]
    public ?string $if;

    #[Api(nullable: true, optional: true)]
    public ?string $ref;

    /** @var value-of<Action> $action */
    #[Api(enum: Action::class)]
    public string $action;

    /** @var value-of<MergeAlgorithm> $mergeStrategy */
    #[Api('merge_strategy', enum: MergeAlgorithm::class)]
    public string $mergeStrategy;

    #[Api]
    public Webhook $webhook;

    #[Api('idempotency_expiry', nullable: true, optional: true)]
    public ?string $idempotencyExpiry;

    #[Api('idempotency_key', nullable: true, optional: true)]
    public ?string $idempotencyKey;

    /**
     * `new AutomationFetchDataStep()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AutomationFetchDataStep::with(action: ..., mergeStrategy: ..., webhook: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AutomationFetchDataStep)
     *   ->withAction(...)
     *   ->withMergeStrategy(...)
     *   ->withWebhook(...)
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
     * @param MergeAlgorithm|value-of<MergeAlgorithm> $mergeStrategy
     */
    public static function with(
        Action|string $action,
        MergeAlgorithm|string $mergeStrategy,
        Webhook $webhook,
        ?string $if = null,
        ?string $ref = null,
        ?string $idempotencyExpiry = null,
        ?string $idempotencyKey = null,
    ): self {
        $obj = new self;

        $obj->action = $action instanceof Action ? $action->value : $action;
        $obj->mergeStrategy = $mergeStrategy instanceof MergeAlgorithm ? $mergeStrategy->value : $mergeStrategy;
        $obj->webhook = $webhook;

        null !== $if && $obj->if = $if;
        null !== $ref && $obj->ref = $ref;
        null !== $idempotencyExpiry && $obj->idempotencyExpiry = $idempotencyExpiry;
        null !== $idempotencyKey && $obj->idempotencyKey = $idempotencyKey;

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
     * @param MergeAlgorithm|value-of<MergeAlgorithm> $mergeStrategy
     */
    public function withMergeStrategy(
        MergeAlgorithm|string $mergeStrategy
    ): self {
        $obj = clone $this;
        $obj->mergeStrategy = $mergeStrategy instanceof MergeAlgorithm ? $mergeStrategy->value : $mergeStrategy;

        return $obj;
    }

    public function withWebhook(Webhook $webhook): self
    {
        $obj = clone $this;
        $obj->webhook = $webhook;

        return $obj;
    }

    public function withIdempotencyExpiry(?string $idempotencyExpiry): self
    {
        $obj = clone $this;
        $obj->idempotencyExpiry = $idempotencyExpiry;

        return $obj;
    }

    public function withIdempotencyKey(?string $idempotencyKey): self
    {
        $obj = clone $this;
        $obj->idempotencyKey = $idempotencyKey;

        return $obj;
    }
}
