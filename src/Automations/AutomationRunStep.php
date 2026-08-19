<?php

declare(strict_types=1);

namespace Courier\Automations;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * One executed step of an Automation run.
 *
 * @phpstan-type AutomationRunStepShape = array{
 *   action: string,
 *   status: string,
 *   createdAt?: string|null,
 *   messageID?: string|null,
 *   stepID?: string|null,
 *   updatedAt?: string|null,
 * }
 */
final class AutomationRunStep implements BaseModel
{
    /** @use SdkModel<AutomationRunStepShape> */
    use SdkModel;

    /**
     * The kind of step that ran, e.g. `send`, `delay`, or `update-profile`.
     */
    #[Required]
    public string $action;

    /**
     * The state of the step: the seven run statuses, plus `SKIPPED` and `COMPUTING`. Not an enum — new values have been added before.
     */
    #[Required]
    public string $status;

    /**
     * When the step started, as an ISO 8601 timestamp.
     */
    #[Optional('created_at')]
    public ?string $createdAt;

    /**
     * The message this step produced, present on send steps. Pass it to `GET /messages/{message_id}` for delivery status. A send to a List or an Audience yields one id for the request, not one per recipient.
     */
    #[Optional('message_id')]
    public ?string $messageID;

    /**
     * A unique identifier representing the step.
     */
    #[Optional('step_id')]
    public ?string $stepID;

    /**
     * When the step last changed state, as an ISO 8601 timestamp.
     */
    #[Optional('updated_at')]
    public ?string $updatedAt;

    /**
     * `new AutomationRunStep()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AutomationRunStep::with(action: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AutomationRunStep)->withAction(...)->withStatus(...)
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
     */
    public static function with(
        string $action,
        string $status,
        ?string $createdAt = null,
        ?string $messageID = null,
        ?string $stepID = null,
        ?string $updatedAt = null,
    ): self {
        $self = new self;

        $self['action'] = $action;
        $self['status'] = $status;

        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $messageID && $self['messageID'] = $messageID;
        null !== $stepID && $self['stepID'] = $stepID;
        null !== $updatedAt && $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * The kind of step that ran, e.g. `send`, `delay`, or `update-profile`.
     */
    public function withAction(string $action): self
    {
        $self = clone $this;
        $self['action'] = $action;

        return $self;
    }

    /**
     * The state of the step: the seven run statuses, plus `SKIPPED` and `COMPUTING`. Not an enum — new values have been added before.
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * When the step started, as an ISO 8601 timestamp.
     */
    public function withCreatedAt(string $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The message this step produced, present on send steps. Pass it to `GET /messages/{message_id}` for delivery status. A send to a List or an Audience yields one id for the request, not one per recipient.
     */
    public function withMessageID(string $messageID): self
    {
        $self = clone $this;
        $self['messageID'] = $messageID;

        return $self;
    }

    /**
     * A unique identifier representing the step.
     */
    public function withStepID(string $stepID): self
    {
        $self = clone $this;
        $self['stepID'] = $stepID;

        return $self;
    }

    /**
     * When the step last changed state, as an ISO 8601 timestamp.
     */
    public function withUpdatedAt(string $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }
}
