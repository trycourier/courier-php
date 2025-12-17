<?php

declare(strict_types=1);

namespace Courier\Bulk;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Creates a new bulk job for sending messages to multiple recipients.
 *
 * **Required**: `message.event` (event ID or notification ID)
 *
 * **Optional (V2 format)**: `message.template` (notification ID) or `message.content` (Elemental content)
 * can be provided to override the notification associated with the event.
 *
 * @see Courier\Services\BulkService::createJob()
 *
 * @phpstan-import-type InboundBulkMessageShape from \Courier\Bulk\InboundBulkMessage
 *
 * @phpstan-type BulkCreateJobParamsShape = array{message: InboundBulkMessageShape}
 */
final class BulkCreateJobParams implements BaseModel
{
    /** @use SdkModel<BulkCreateJobParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Bulk message definition. Supports two formats:
     * - V1 format: Requires `event` field (event ID or notification ID)
     * - V2 format: Optionally use `template` (notification ID) or `content` (Elemental content) in addition to `event`
     */
    #[Required]
    public InboundBulkMessage $message;

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
     * @param InboundBulkMessageShape $message
     */
    public static function with(InboundBulkMessage|array $message): self
    {
        $self = new self;

        $self['message'] = $message;

        return $self;
    }

    /**
     * Bulk message definition. Supports two formats:
     * - V1 format: Requires `event` field (event ID or notification ID)
     * - V2 format: Optionally use `template` (notification ID) or `content` (Elemental content) in addition to `event`
     *
     * @param InboundBulkMessageShape $message
     */
    public function withMessage(InboundBulkMessage|array $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }
}
