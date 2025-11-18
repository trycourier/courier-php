<?php

declare(strict_types=1);

namespace Courier\Bulk;

use Courier\Bulk\InboundBulkMessage\InboundBulkContentMessage;
use Courier\Bulk\InboundBulkMessage\InboundBulkTemplateMessage;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Create a bulk job.
 *
 * @see Courier\Services\BulkService::createJob()
 *
 * @phpstan-type BulkCreateJobParamsShape = array{
 *   message: InboundBulkTemplateMessage|InboundBulkContentMessage
 * }
 */
final class BulkCreateJobParams implements BaseModel
{
    /** @use SdkModel<BulkCreateJobParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public InboundBulkTemplateMessage|InboundBulkContentMessage $message;

    /**
     * `new BulkCreateJobParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BulkCreateJobParams::with(message: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BulkCreateJobParams)->withMessage(...)
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
        InboundBulkTemplateMessage|InboundBulkContentMessage $message
    ): self {
        $obj = new self;

        $obj->message = $message;

        return $obj;
    }

    public function withMessage(
        InboundBulkTemplateMessage|InboundBulkContentMessage $message
    ): self {
        $obj = clone $this;
        $obj->message = $message;

        return $obj;
    }
}
