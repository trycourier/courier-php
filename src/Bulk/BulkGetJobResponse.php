<?php

declare(strict_types=1);

namespace Courier\Bulk;

use Courier\Bulk\BulkGetJobResponse\Job;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type JobShape from \Courier\Bulk\BulkGetJobResponse\Job
 *
 * @phpstan-type BulkGetJobResponseShape = array{job: Job|JobShape}
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
     * @param JobShape $job
     */
    public static function with(Job|array $job): self
    {
        $self = new self;

        $self['job'] = $job;

        return $self;
    }

    /**
     * @param JobShape $job
     */
    public function withJob(Job|array $job): self
    {
        $self = clone $this;
        $self['job'] = $job;

        return $self;
    }
}
