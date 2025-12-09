<?php

declare(strict_types=1);

namespace Courier\Bulk;

use Courier\Bulk\BulkGetJobResponse\Job;
use Courier\Bulk\BulkGetJobResponse\Job\Status;
use Courier\Bulk\InboundBulkMessage\InboundBulkContentMessage;
use Courier\Bulk\InboundBulkMessage\InboundBulkTemplateMessage;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type BulkGetJobResponseShape = array{job: Job}
 */
final class BulkGetJobResponse implements BaseModel
{
    /** @use SdkModel<BulkGetJobResponseShape> */
    use SdkModel;

    #[Api]
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
     *   definition: InboundBulkTemplateMessage|InboundBulkContentMessage,
     *   enqueued: int,
     *   failures: int,
     *   received: int,
     *   status: value-of<Status>,
     * } $job
     */
    public static function with(Job|array $job): self
    {
        $obj = new self;

        $obj['job'] = $job;

        return $obj;
    }

    /**
     * @param Job|array{
     *   definition: InboundBulkTemplateMessage|InboundBulkContentMessage,
     *   enqueued: int,
     *   failures: int,
     *   received: int,
     *   status: value-of<Status>,
     * } $job
     */
    public function withJob(Job|array $job): self
    {
        $obj = clone $this;
        $obj['job'] = $job;

        return $obj;
    }
}
