<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationSendListStep\Action;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type automation_send_list_step = array{
 *   if?: string|null,
 *   ref?: string|null,
 *   action: value-of<Action>,
 *   list: string,
 *   brand?: string|null,
 *   data?: array<string, mixed>|null,
 *   override?: array<string, mixed>|null,
 *   template?: string|null,
 * }
 */
final class AutomationSendListStep implements BaseModel
{
    /** @use SdkModel<automation_send_list_step> */
    use SdkModel;

    #[Api(nullable: true, optional: true)]
    public ?string $if;

    #[Api(nullable: true, optional: true)]
    public ?string $ref;

    /** @var value-of<Action> $action */
    #[Api(enum: Action::class)]
    public string $action;

    #[Api]
    public string $list;

    #[Api(nullable: true, optional: true)]
    public ?string $brand;

    /** @var array<string, mixed>|null $data */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $data;

    /** @var array<string, mixed>|null $override */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $override;

    #[Api(nullable: true, optional: true)]
    public ?string $template;

    /**
     * `new AutomationSendListStep()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AutomationSendListStep::with(action: ..., list: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AutomationSendListStep)->withAction(...)->withList(...)
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
     * @param array<string, mixed>|null $data
     * @param array<string, mixed>|null $override
     */
    public static function with(
        Action|string $action,
        string $list,
        ?string $if = null,
        ?string $ref = null,
        ?string $brand = null,
        ?array $data = null,
        ?array $override = null,
        ?string $template = null,
    ): self {
        $obj = new self;

        $obj->action = $action instanceof Action ? $action->value : $action;
        $obj->list = $list;

        null !== $if && $obj->if = $if;
        null !== $ref && $obj->ref = $ref;
        null !== $brand && $obj->brand = $brand;
        null !== $data && $obj->data = $data;
        null !== $override && $obj->override = $override;
        null !== $template && $obj->template = $template;

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

    public function withList(string $list): self
    {
        $obj = clone $this;
        $obj->list = $list;

        return $obj;
    }

    public function withBrand(?string $brand): self
    {
        $obj = clone $this;
        $obj->brand = $brand;

        return $obj;
    }

    /**
     * @param array<string, mixed>|null $data
     */
    public function withData(?array $data): self
    {
        $obj = clone $this;
        $obj->data = $data;

        return $obj;
    }

    /**
     * @param array<string, mixed>|null $override
     */
    public function withOverride(?array $override): self
    {
        $obj = clone $this;
        $obj->override = $override;

        return $obj;
    }

    public function withTemplate(?string $template): self
    {
        $obj = clone $this;
        $obj->template = $template;

        return $obj;
    }
}
