<?php

declare(strict_types=1);

namespace Courier\Bulk;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkResponse;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type BulkNewJobResponseShape = array{jobId: string}
 */
final class BulkNewJobResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<BulkNewJobResponseShape> */
    use SdkModel;

    use SdkResponse;

    #[Api]
    public string $jobId;

    /**
     * `new BulkNewJobResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BulkNewJobResponse::with(jobId: ...)
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
    public static function with(string $jobId): self
    {
        $obj = new self;

        $obj['jobId'] = $jobId;

        return $obj;
    }

    public function withJobID(string $jobID): self
    {
        $obj = clone $this;
        $obj['jobId'] = $jobID;

        return $obj;
    }
}
