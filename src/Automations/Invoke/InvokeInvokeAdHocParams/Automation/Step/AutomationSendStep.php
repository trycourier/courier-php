<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationSendStep\Action;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type AutomationSendStepShape = array{
 *   action: value-of<Action>,
 *   brand?: string|null,
 *   data?: array<string,mixed>|null,
 *   profile?: array<string,mixed>|null,
 *   recipient?: string|null,
 *   template?: string|null,
 * }
 */
final class AutomationSendStep implements BaseModel
{
    /** @use SdkModel<AutomationSendStepShape> */
    use SdkModel;

    /** @var value-of<Action> $action */
    #[Required(enum: Action::class)]
    public string $action;

    #[Optional(nullable: true)]
    public ?string $brand;

    /** @var array<string,mixed>|null $data */
    #[Optional(map: 'mixed', nullable: true)]
    public ?array $data;

    /** @var array<string,mixed>|null $profile */
    #[Optional(map: 'mixed', nullable: true)]
    public ?array $profile;

    #[Optional(nullable: true)]
    public ?string $recipient;

    #[Optional(nullable: true)]
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
     * @param array<string,mixed>|null $data
     * @param array<string,mixed>|null $profile
     */
    public static function with(
        Action|string $action,
        ?string $brand = null,
        ?array $data = null,
        ?array $profile = null,
        ?string $recipient = null,
        ?string $template = null,
    ): self {
        $self = new self;

        $self['action'] = $action;

        null !== $brand && $self['brand'] = $brand;
        null !== $data && $self['data'] = $data;
        null !== $profile && $self['profile'] = $profile;
        null !== $recipient && $self['recipient'] = $recipient;
        null !== $template && $self['template'] = $template;

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

    public function withBrand(?string $brand): self
    {
        $self = clone $this;
        $self['brand'] = $brand;

        return $self;
    }

    /**
     * @param array<string,mixed>|null $data
     */
    public function withData(?array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * @param array<string,mixed>|null $profile
     */
    public function withProfile(?array $profile): self
    {
        $self = clone $this;
        $self['profile'] = $profile;

        return $self;
    }

    public function withRecipient(?string $recipient): self
    {
        $self = clone $this;
        $self['recipient'] = $recipient;

        return $self;
    }

    public function withTemplate(?string $template): self
    {
        $self = clone $this;
        $self['template'] = $template;

        return $self;
    }
}
