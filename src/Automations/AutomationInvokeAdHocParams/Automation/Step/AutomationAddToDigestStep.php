<?php

declare(strict_types=1);

namespace Courier\Automations\AutomationInvokeAdHocParams\Automation\Step;

use Courier\Automations\AutomationInvokeAdHocParams\Automation\Step\AutomationAddToDigestStep\Action;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type automation_add_to_digest_step = array{
 *   if?: string|null,
 *   ref?: string|null,
 *   action: value-of<Action>,
 *   subscriptionTopicID: string,
 * }
 */
final class AutomationAddToDigestStep implements BaseModel
{
    /** @use SdkModel<automation_add_to_digest_step> */
    use SdkModel;

    #[Api(nullable: true, optional: true)]
    public ?string $if;

    #[Api(nullable: true, optional: true)]
    public ?string $ref;

    /** @var value-of<Action> $action */
    #[Api(enum: Action::class)]
    public string $action;

    /**
     * The subscription topic that has digests enabled.
     */
    #[Api('subscription_topic_id')]
    public string $subscriptionTopicID;

    /**
     * `new AutomationAddToDigestStep()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AutomationAddToDigestStep::with(action: ..., subscriptionTopicID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AutomationAddToDigestStep)->withAction(...)->withSubscriptionTopicID(...)
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
        string $subscriptionTopicID,
        ?string $if = null,
        ?string $ref = null,
    ): self {
        $obj = new self;

        $obj->action = $action instanceof Action ? $action->value : $action;
        $obj->subscriptionTopicID = $subscriptionTopicID;

        null !== $if && $obj->if = $if;
        null !== $ref && $obj->ref = $ref;

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
     * The subscription topic that has digests enabled.
     */
    public function withSubscriptionTopicID(string $subscriptionTopicID): self
    {
        $obj = clone $this;
        $obj->subscriptionTopicID = $subscriptionTopicID;

        return $obj;
    }
}
