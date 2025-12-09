<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationSendListStep\Action;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type AutomationSendListStepShape = array{
 *   action: value-of<Action>,
 *   list: string,
 *   brand?: string|null,
 *   data?: array<string,mixed>|null,
 * }
 */
final class AutomationSendListStep implements BaseModel
{
    /** @use SdkModel<AutomationSendListStepShape> */
    use SdkModel;

    /** @var value-of<Action> $action */
    #[Required(enum: Action::class)]
    public string $action;

    #[Required]
    public string $list;

    #[Optional(nullable: true)]
    public ?string $brand;

    /** @var array<string,mixed>|null $data */
    #[Optional(map: 'mixed', nullable: true)]
    public ?array $data;

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
     * @param array<string,mixed>|null $data
     */
    public static function with(
        Action|string $action,
        string $list,
        ?string $brand = null,
        ?array $data = null,
    ): self {
        $obj = new self;

        $obj['action'] = $action;
        $obj['list'] = $list;

        null !== $brand && $obj['brand'] = $brand;
        null !== $data && $obj['data'] = $data;

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

    public function withList(string $list): self
    {
        $obj = clone $this;
        $obj['list'] = $list;

        return $obj;
    }

    public function withBrand(?string $brand): self
    {
        $obj = clone $this;
        $obj['brand'] = $brand;

        return $obj;
    }

    /**
     * @param array<string,mixed>|null $data
     */
    public function withData(?array $data): self
    {
        $obj = clone $this;
        $obj['data'] = $data;

        return $obj;
    }
}
