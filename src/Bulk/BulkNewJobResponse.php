<?php

declare(strict_types=1);

namespace Courier\Bulk;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type bulk_new_job_response = array{jobID: string}
 * When used in a response, this type parameter can define a $rawResponse property.
 * @template TRawResponse of object = object{}
 *
 * @mixin TRawResponse
 */
final class BulkNewJobResponse implements BaseModel
{
    /** @use SdkModel<bulk_new_job_response> */
    use SdkModel;

    #[Api('jobId')]
    public string $jobID;

    /**
     * `new BulkNewJobResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BulkNewJobResponse::with(jobID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BulkNewJobResponse)->withJobID(...)
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
    public static function with(string $jobID): self
    {
        $obj = new self;

        $obj->jobID = $jobID;

        return $obj;
    }

    public function withJobID(string $jobID): self
    {
        $obj = clone $this;
        $obj->jobID = $jobID;

        return $obj;
    }
}
