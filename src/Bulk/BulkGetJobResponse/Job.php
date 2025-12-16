<?php

declare(strict_types=1);

namespace Courier\Bulk\BulkGetJobResponse;

use Courier\Bulk\BulkGetJobResponse\Job\Status;
use Courier\Bulk\InboundBulkMessage;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\ElementalContent;
use Courier\ElementalContentSugar;

/**
 * @phpstan-type JobShape = array{
 *   definition: InboundBulkMessage,
 *   enqueued: int,
 *   failures: int,
 *   received: int,
 *   status: value-of<Status>,
 * }
 */
final class Job implements BaseModel
{
    /** @use SdkModel<JobShape> */
    use SdkModel;

    /**
     * Bulk message definition. Supports two formats:
     * - V1 format: Requires `event` field (event ID or notification ID)
     * - V2 format: Optionally use `template` (notification ID) or `content` (Elemental content) in addition to `event`
     */
    #[Required]
    public InboundBulkMessage $definition;

    #[Required]
    public int $enqueued;

    #[Required]
    public int $failures;

    #[Required]
    public int $received;

    /** @var value-of<Status> $status */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * `new Job()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Job::with(
     *   definition: ..., enqueued: ..., failures: ..., received: ..., status: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Job)
     *   ->withDefinition(...)
     *   ->withEnqueued(...)
     *   ->withFailures(...)
     *   ->withReceived(...)
     *   ->withStatus(...)
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
     * @param InboundBulkMessage|array{
     *   event: string,
     *   brand?: string|null,
     *   content?: ElementalContentSugar|ElementalContent|null,
     *   data?: array<string,mixed>|null,
     *   locale?: array<string,array<string,mixed>>|null,
     *   override?: array<string,mixed>|null,
     *   template?: string|null,
     * } $definition
     * @param Status|value-of<Status> $status
     */
    public static function with(
        InboundBulkMessage|array $definition,
        int $enqueued,
        int $failures,
        int $received,
        Status|string $status,
    ): self {
        $self = new self;

        $self['definition'] = $definition;
        $self['enqueued'] = $enqueued;
        $self['failures'] = $failures;
        $self['received'] = $received;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Bulk message definition. Supports two formats:
     * - V1 format: Requires `event` field (event ID or notification ID)
     * - V2 format: Optionally use `template` (notification ID) or `content` (Elemental content) in addition to `event`
     *
     * @param InboundBulkMessage|array{
     *   event: string,
     *   brand?: string|null,
     *   content?: ElementalContentSugar|ElementalContent|null,
     *   data?: array<string,mixed>|null,
     *   locale?: array<string,array<string,mixed>>|null,
     *   override?: array<string,mixed>|null,
     *   template?: string|null,
     * } $definition
     */
    public function withDefinition(InboundBulkMessage|array $definition): self
    {
        $self = clone $this;
        $self['definition'] = $definition;

        return $self;
    }

    public function withEnqueued(int $enqueued): self
    {
        $self = clone $this;
        $self['enqueued'] = $enqueued;

        return $self;
    }

    public function withFailures(int $failures): self
    {
        $self = clone $this;
        $self['failures'] = $failures;

        return $self;
    }

    public function withReceived(int $received): self
    {
        $self = clone $this;
        $self['received'] = $received;

        return $self;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
