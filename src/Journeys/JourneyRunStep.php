<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * One executed node of a Journey run. `node_id` is the id of the node in the published Journey, so a step maps directly onto the Journey graph.
 *
 * @phpstan-type JourneyRunStepShape = array{
 *   action: string,
 *   status: string,
 *   createdAt?: string|null,
 *   messageID?: string|null,
 *   nodeID?: string|null,
 *   updatedAt?: string|null,
 * }
 */
final class JourneyRunStep implements BaseModel
{
    /** @use SdkModel<JourneyRunStepShape> */
    use SdkModel;

    /**
     * The kind of node that ran, e.g. `send`, `delay`, or `exit`.
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
     * The id of the node in the published Journey that this step executed.
     */
    #[Optional('node_id')]
    public ?string $nodeID;

    /**
     * When the step last changed state, as an ISO 8601 timestamp.
     */
    #[Optional('updated_at')]
    public ?string $updatedAt;

    /**
     * `new JourneyRunStep()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneyRunStep::with(action: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneyRunStep)->withAction(...)->withStatus(...)
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
        ?string $nodeID = null,
        ?string $updatedAt = null,
    ): self {
        $self = new self;

        $self['action'] = $action;
        $self['status'] = $status;

        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $messageID && $self['messageID'] = $messageID;
        null !== $nodeID && $self['nodeID'] = $nodeID;
        null !== $updatedAt && $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * The kind of node that ran, e.g. `send`, `delay`, or `exit`.
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
     * The id of the node in the published Journey that this step executed.
     */
    public function withNodeID(string $nodeID): self
    {
        $self = clone $this;
        $self['nodeID'] = $nodeID;

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
