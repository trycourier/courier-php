<?php

declare(strict_types=1);

namespace Courier\Bulk;

use Courier\Bulk\InboundBulkMessage\InboundBulkContentMessage;
use Courier\Bulk\InboundBulkMessage\InboundBulkTemplateMessage;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\ElementalContent;
use Courier\ElementalContentSugar;

/**
 * Create a bulk job.
 *
 * @see Courier\Services\BulkService::createJob()
 *
 * @phpstan-type BulkCreateJobParamsShape = array{
 *   message: InboundBulkTemplateMessage|array{
 *     template: string,
 *     brand?: string|null,
 *     data?: array<string,mixed>|null,
 *     event?: string|null,
 *     locale?: array<string,array<string,mixed>>|null,
 *     override?: array<string,mixed>|null,
 *   }|InboundBulkContentMessage|array{
 *     content: ElementalContentSugar|ElementalContent,
 *     brand?: string|null,
 *     data?: array<string,mixed>|null,
 *     event?: string|null,
 *     locale?: array<string,array<string,mixed>>|null,
 *     override?: array<string,mixed>|null,
 *   },
 * }
 */
final class BulkCreateJobParams implements BaseModel
{
    /** @use SdkModel<BulkCreateJobParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
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
     *
     * @param InboundBulkTemplateMessage|array{
     *   template: string,
     *   brand?: string|null,
     *   data?: array<string,mixed>|null,
     *   event?: string|null,
     *   locale?: array<string,array<string,mixed>>|null,
     *   override?: array<string,mixed>|null,
     * }|InboundBulkContentMessage|array{
     *   content: ElementalContentSugar|ElementalContent,
     *   brand?: string|null,
     *   data?: array<string,mixed>|null,
     *   event?: string|null,
     *   locale?: array<string,array<string,mixed>>|null,
     *   override?: array<string,mixed>|null,
     * } $message
     */
    public static function with(
        InboundBulkTemplateMessage|array|InboundBulkContentMessage $message
    ): self {
        $self = new self;

        $self['message'] = $message;

        return $self;
    }

    /**
     * @param InboundBulkTemplateMessage|array{
     *   template: string,
     *   brand?: string|null,
     *   data?: array<string,mixed>|null,
     *   event?: string|null,
     *   locale?: array<string,array<string,mixed>>|null,
     *   override?: array<string,mixed>|null,
     * }|InboundBulkContentMessage|array{
     *   content: ElementalContentSugar|ElementalContent,
     *   brand?: string|null,
     *   data?: array<string,mixed>|null,
     *   event?: string|null,
     *   locale?: array<string,array<string,mixed>>|null,
     *   override?: array<string,mixed>|null,
     * } $message
     */
    public function withMessage(
        InboundBulkTemplateMessage|array|InboundBulkContentMessage $message
    ): self {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }
}
