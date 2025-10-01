<?php

declare(strict_types=1);

namespace Courier\Bulk\BulkGetJobResponse;

use Courier\Bulk\BulkGetJobResponse\Job\Status;
use Courier\Bulk\InboundBulkMessage;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type job_alias = array{
 *   definition: InboundBulkMessage,
 *   enqueued: int,
 *   failures: int,
 *   received: int,
 *   status: value-of<Status>,
 * }
 */
final class Job implements BaseModel
{
    /** @use SdkModel<job_alias> */
    use SdkModel;

    #[Api]
    public InboundBulkMessage $definition;

    #[Api]
    public int $enqueued;

    #[Api]
    public int $failures;

    #[Api]
    public int $received;

    /** @var value-of<Status> $status */
    #[Api(enum: Status::class)]
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
     * @param Status|value-of<Status> $status
     */
    public static function with(
        InboundBulkMessage $definition,
        int $enqueued,
        int $failures,
        int $received,
        Status|string $status,
    ): self {
        $obj = new self;

        $obj->definition = $definition;
        $obj->enqueued = $enqueued;
        $obj->failures = $failures;
        $obj->received = $received;
        $obj->status = $status instanceof Status ? $status->value : $status;

        return $obj;
    }

    public function withDefinition(InboundBulkMessage $definition): self
    {
        $obj = clone $this;
        $obj->definition = $definition;

        return $obj;
    }

    public function withEnqueued(int $enqueued): self
    {
        $obj = clone $this;
        $obj->enqueued = $enqueued;

        return $obj;
    }

    public function withFailures(int $failures): self
    {
        $obj = clone $this;
        $obj->failures = $failures;

        return $obj;
    }

    public function withReceived(int $received): self
    {
        $obj = clone $this;
        $obj->received = $received;

        return $obj;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $obj = clone $this;
        $obj->status = $status instanceof Status ? $status->value : $status;

        return $obj;
    }
}
