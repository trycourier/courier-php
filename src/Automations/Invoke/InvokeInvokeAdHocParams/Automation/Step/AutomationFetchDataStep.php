<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationFetchDataStep\Action;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationFetchDataStep\MergeStrategy;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationFetchDataStep\Webhook;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type WebhookShape from \Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationFetchDataStep\Webhook
 *
 * @phpstan-type AutomationFetchDataStepShape = array{
 *   action: Action|value-of<Action>,
 *   webhook: Webhook|WebhookShape,
 *   mergeStrategy?: null|MergeStrategy|value-of<MergeStrategy>,
 * }
 */
final class AutomationFetchDataStep implements BaseModel
{
    /** @use SdkModel<AutomationFetchDataStepShape> */
    use SdkModel;

    /** @var value-of<Action> $action */
    #[Required(enum: Action::class)]
    public string $action;

    #[Required]
    public Webhook $webhook;

    /** @var value-of<MergeStrategy>|null $mergeStrategy */
    #[Optional('merge_strategy', enum: MergeStrategy::class, nullable: true)]
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
     * @param WebhookShape $webhook
     * @param MergeStrategy|value-of<MergeStrategy>|null $mergeStrategy
     */
    public static function with(
        Action|string $action,
        Webhook|array $webhook,
        MergeStrategy|string|null $mergeStrategy = null,
    ): self {
        $self = new self;

        $self['action'] = $action;
        $self['webhook'] = $webhook;

        null !== $mergeStrategy && $self['mergeStrategy'] = $mergeStrategy;

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
     * @param WebhookShape $webhook
     */
    public function withWebhook(Webhook|array $webhook): self
    {
        $self = clone $this;
        $self['webhook'] = $webhook;

        return $self;
    }

    /**
     * @param MergeStrategy|value-of<MergeStrategy>|null $mergeStrategy
     */
    public function withMergeStrategy(
        MergeStrategy|string|null $mergeStrategy
    ): self {
        $self = clone $this;
        $self['mergeStrategy'] = $mergeStrategy;

        return $self;
    }
}
