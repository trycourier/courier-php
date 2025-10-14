<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationSendStep\Action;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type automation_send_step = array{
 *   action: value-of<Action>,
 *   brand?: string|null,
 *   data?: array<string, mixed>|null,
 *   profile?: array<string, mixed>|null,
 *   recipient?: string|null,
 *   template?: string|null,
 * }
 */
final class AutomationSendStep implements BaseModel
{
    /** @use SdkModel<automation_send_step> */
    use SdkModel;

    /** @var value-of<Action> $action */
    #[Api(enum: Action::class)]
    public string $action;

    #[Api(nullable: true, optional: true)]
    public ?string $brand;

    /** @var array<string, mixed>|null $data */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $data;

    /** @var array<string, mixed>|null $profile */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $profile;

    #[Api(nullable: true, optional: true)]
    public ?string $recipient;

    #[Api(nullable: true, optional: true)]
    public ?string $template;

    /**
     * `new AutomationSendStep()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AutomationSendStep::with(action: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AutomationSendStep)->withAction(...)
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
     * @param array<string, mixed>|null $profile
     */
    public static function with(
        Action|string $action,
        ?string $brand = null,
        ?array $data = null,
        ?array $profile = null,
        ?string $recipient = null,
        ?string $template = null,
    ): self {
        $obj = new self;

        $obj['action'] = $action;

        null !== $brand && $obj->brand = $brand;
        null !== $data && $obj->data = $data;
        null !== $profile && $obj->profile = $profile;
        null !== $recipient && $obj->recipient = $recipient;
        null !== $template && $obj->template = $template;

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
     * @param array<string, mixed>|null $profile
     */
    public function withProfile(?array $profile): self
    {
        $obj = clone $this;
        $obj->profile = $profile;

        return $obj;
    }

    public function withRecipient(?string $recipient): self
    {
        $obj = clone $this;
        $obj->recipient = $recipient;

        return $obj;
    }

    public function withTemplate(?string $template): self
    {
        $obj = clone $this;
        $obj->template = $template;

        return $obj;
    }
}
