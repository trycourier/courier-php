<?php

declare(strict_types=1);

namespace Courier\Bulk;

use Courier\Bulk\BulkGetJobResponse\Job;
use Courier\Bulk\BulkGetJobResponse\Job\Status;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type BulkGetJobResponseShape = array{job: Job}
 */
final class BulkGetJobResponse implements BaseModel
{
    /** @use SdkModel<BulkGetJobResponseShape> */
    use SdkModel;

    #[Required]
    public Job $job;

    /**
     * `new BulkGetJobResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BulkGetJobResponse::with(job: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BulkGetJobResponse)->withJob(...)
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
     * @param Job|array{
     *   definition: InboundBulkMessage,
     *   enqueued: int,
     *   failures: int,
     *   received: int,
     *   status: value-of<Status>,
     * } $job
     */
    public static function with(Job|array $job): self
    {
        $self = new self;

        $self['job'] = $job;

        return $self;
    }

    /**
     * @param Job|array{
     *   definition: InboundBulkMessage,
     *   enqueued: int,
     *   failures: int,
     *   received: int,
     *   status: value-of<Status>,
     * } $job
     */
    public function withJob(Job|array $job): self
    {
        $self = clone $this;
        $self['job'] = $job;

        return $self;
    }
}
