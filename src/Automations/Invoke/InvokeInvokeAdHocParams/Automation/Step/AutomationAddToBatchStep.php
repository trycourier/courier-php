<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationAddToBatchStep\Action;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationAddToBatchStep\Retain;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationAddToBatchStep\Scope;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type automation_add_to_batch_step = array{
 *   if?: string|null,
 *   ref?: string|null,
 *   action: value-of<Action>,
 *   maxWaitPeriod: string,
 *   retain: Retain,
 *   waitPeriod: string,
 *   batchID?: string|null,
 *   batchKey?: string|null,
 *   categoryKey?: string|null,
 *   maxItems?: string|int|null,
 *   scope?: value-of<Scope>|null,
 * }
 */
final class AutomationAddToBatchStep implements BaseModel
{
    /** @use SdkModel<automation_add_to_batch_step> */
    use SdkModel;

    #[Api(nullable: true, optional: true)]
    public ?string $if;

    #[Api(nullable: true, optional: true)]
    public ?string $ref;

    /** @var value-of<Action> $action */
    #[Api(enum: Action::class)]
    public string $action;

    /**
     * Defines the maximum wait time before the batch should be released. Must be less than wait period. Maximum of 60 days. Specified as an [ISO 8601 duration](https://en.wikipedia.org/wiki/ISO_8601#Durations).
     */
    #[Api('max_wait_period')]
    public string $maxWaitPeriod;

    /**
     * Defines what items should be retained and passed along to the next steps when the batch is released.
     */
    #[Api]
    public Retain $retain;

    /**
     * Defines the period of inactivity before the batch is released. Specified as an [ISO 8601 duration](https://en.wikipedia.org/wiki/ISO_8601#Durations).
     */
    #[Api('wait_period')]
    public string $waitPeriod;

    #[Api('batch_id', nullable: true, optional: true)]
    public ?string $batchID;

    /**
     * If using scope=dynamic, provide the key or a reference (e.g., refs.data.batch_key).
     */
    #[Api('batch_key', nullable: true, optional: true)]
    public ?string $batchKey;

    /**
     * Defines the field of the data object the batch is set to when complete. Defaults to `batch`.
     */
    #[Api('category_key', nullable: true, optional: true)]
    public ?string $categoryKey;

    /**
     * If specified, the batch will release as soon as this number is reached.
     */
    #[Api('max_items', nullable: true, optional: true)]
    public string|int|null $maxItems;

    /**
     * Determine the scope of the batching. If user, chosen in this order: recipient, profile.user_id, data.user_id, data.userId.
     * If dynamic, then specify where the batch_key or a reference to the batch_key.
     *
     * @var value-of<Scope>|null $scope
     */
    #[Api(enum: Scope::class, nullable: true, optional: true)]
    public ?string $scope;

    /**
     * `new AutomationAddToBatchStep()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AutomationAddToBatchStep::with(
     *   action: ..., maxWaitPeriod: ..., retain: ..., waitPeriod: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AutomationAddToBatchStep)
     *   ->withAction(...)
     *   ->withMaxWaitPeriod(...)
     *   ->withRetain(...)
     *   ->withWaitPeriod(...)
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
     * @param Scope|value-of<Scope>|null $scope
     */
    public static function with(
        Action|string $action,
        string $maxWaitPeriod,
        Retain $retain,
        string $waitPeriod,
        ?string $if = null,
        ?string $ref = null,
        ?string $batchID = null,
        ?string $batchKey = null,
        ?string $categoryKey = null,
        string|int|null $maxItems = null,
        Scope|string|null $scope = null,
    ): self {
        $obj = new self;

        $obj->action = $action instanceof Action ? $action->value : $action;
        $obj->maxWaitPeriod = $maxWaitPeriod;
        $obj->retain = $retain;
        $obj->waitPeriod = $waitPeriod;

        null !== $if && $obj->if = $if;
        null !== $ref && $obj->ref = $ref;
        null !== $batchID && $obj->batchID = $batchID;
        null !== $batchKey && $obj->batchKey = $batchKey;
        null !== $categoryKey && $obj->categoryKey = $categoryKey;
        null !== $maxItems && $obj->maxItems = $maxItems;
        null !== $scope && $obj->scope = $scope instanceof Scope ? $scope->value : $scope;

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
     * Defines the maximum wait time before the batch should be released. Must be less than wait period. Maximum of 60 days. Specified as an [ISO 8601 duration](https://en.wikipedia.org/wiki/ISO_8601#Durations).
     */
    public function withMaxWaitPeriod(string $maxWaitPeriod): self
    {
        $obj = clone $this;
        $obj->maxWaitPeriod = $maxWaitPeriod;

        return $obj;
    }

    /**
     * Defines what items should be retained and passed along to the next steps when the batch is released.
     */
    public function withRetain(Retain $retain): self
    {
        $obj = clone $this;
        $obj->retain = $retain;

        return $obj;
    }

    /**
     * Defines the period of inactivity before the batch is released. Specified as an [ISO 8601 duration](https://en.wikipedia.org/wiki/ISO_8601#Durations).
     */
    public function withWaitPeriod(string $waitPeriod): self
    {
        $obj = clone $this;
        $obj->waitPeriod = $waitPeriod;

        return $obj;
    }

    public function withBatchID(?string $batchID): self
    {
        $obj = clone $this;
        $obj->batchID = $batchID;

        return $obj;
    }

    /**
     * If using scope=dynamic, provide the key or a reference (e.g., refs.data.batch_key).
     */
    public function withBatchKey(?string $batchKey): self
    {
        $obj = clone $this;
        $obj->batchKey = $batchKey;

        return $obj;
    }

    /**
     * Defines the field of the data object the batch is set to when complete. Defaults to `batch`.
     */
    public function withCategoryKey(?string $categoryKey): self
    {
        $obj = clone $this;
        $obj->categoryKey = $categoryKey;

        return $obj;
    }

    /**
     * If specified, the batch will release as soon as this number is reached.
     */
    public function withMaxItems(string|int|null $maxItems): self
    {
        $obj = clone $this;
        $obj->maxItems = $maxItems;

        return $obj;
    }

    /**
     * Determine the scope of the batching. If user, chosen in this order: recipient, profile.user_id, data.user_id, data.userId.
     * If dynamic, then specify where the batch_key or a reference to the batch_key.
     *
     * @param Scope|value-of<Scope>|null $scope
     */
    public function withScope(Scope|string|null $scope): self
    {
        $obj = clone $this;
        $obj->scope = $scope instanceof Scope ? $scope->value : $scope;

        return $obj;
    }
}
