<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationV2SendStep\Action;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\Message\ContentMessage;
use Courier\Send\Message\TemplateMessage;

/**
 * @phpstan-type automation_v2_send_step = array{
 *   if?: string|null,
 *   ref?: string|null,
 *   action: value-of<Action>,
 *   message: content_message|template_message,
 * }
 */
final class AutomationV2SendStep implements BaseModel
{
    /** @use SdkModel<automation_v2_send_step> */
    use SdkModel;

    #[Api(nullable: true, optional: true)]
    public ?string $if;

    #[Api(nullable: true, optional: true)]
    public ?string $ref;

    /** @var value-of<Action> $action */
    #[Api(enum: Action::class)]
    public string $action;

    /**
     * Describes the content of the message in a way that will work for email, push, chat, or any channel.
     */
    #[Api]
    public ContentMessage|TemplateMessage $message;

    /**
     * `new AutomationV2SendStep()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AutomationV2SendStep::with(action: ..., message: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AutomationV2SendStep)->withAction(...)->withMessage(...)
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
        ContentMessage|TemplateMessage $message,
        ?string $if = null,
        ?string $ref = null,
    ): self {
        $obj = new self;

        $obj->action = $action instanceof Action ? $action->value : $action;
        $obj->message = $message;

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
     * Describes the content of the message in a way that will work for email, push, chat, or any channel.
     */
    public function withMessage(ContentMessage|TemplateMessage $message): self
    {
        $obj = clone $this;
        $obj->message = $message;

        return $obj;
    }
}
