<?php

declare(strict_types=1);

namespace Courier\Broadcasts;

use Courier\Broadcasts\BroadcastSendParams\RecipientType;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Send a broadcast immediately to a list or audience. Publishes the broadcast template first. Not allowed once the broadcast is sending or sent.
 *
 * @see Courier\Services\BroadcastsService::send()
 *
 * @phpstan-type BroadcastSendParamsShape = array{
 *   recipientID: string, recipientType: RecipientType|value-of<RecipientType>
 * }
 */
final class BroadcastSendParams implements BaseModel
{
    /** @use SdkModel<BroadcastSendParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * ID of the target list or audience.
     */
    #[Required('recipient_id')]
    public string $recipientID;

    /**
     * Whether the broadcast targets a list or an audience.
     *
     * @var value-of<RecipientType> $recipientType
     */
    #[Required('recipient_type', enum: RecipientType::class)]
    public string $recipientType;

    /**
     * `new BroadcastSendParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BroadcastSendParams::with(recipientID: ..., recipientType: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BroadcastSendParams)->withRecipientID(...)->withRecipientType(...)
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
     * @param RecipientType|value-of<RecipientType> $recipientType
     */
    public static function with(
        string $recipientID,
        RecipientType|string $recipientType
    ): self {
        $self = new self;

        $self['recipientID'] = $recipientID;
        $self['recipientType'] = $recipientType;

        return $self;
    }

    /**
     * ID of the target list or audience.
     */
    public function withRecipientID(string $recipientID): self
    {
        $self = clone $this;
        $self['recipientID'] = $recipientID;

        return $self;
    }

    /**
     * Whether the broadcast targets a list or an audience.
     *
     * @param RecipientType|value-of<RecipientType> $recipientType
     */
    public function withRecipientType(RecipientType|string $recipientType): self
    {
        $self = clone $this;
        $self['recipientType'] = $recipientType;

        return $self;
    }
}
