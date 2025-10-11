<?php

declare(strict_types=1);

namespace Courier\Bulk;

use Courier\Bulk\BulkGetJobResponse\Job;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkResponse;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type bulk_get_job_response = array{job: Job}
 */
final class BulkGetJobResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<bulk_get_job_response> */
    use SdkModel;

    use SdkResponse;

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
     */
    public static function with(Job $job): self
    {
        $obj = new self;

        $obj->job = $job;

        return $obj;
    }

    public function withJob(Job $job): self
    {
        $obj = clone $this;
        $obj->job = $job;

        return $obj;
    }
}
