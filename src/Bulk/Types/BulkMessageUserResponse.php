<?php

namespace Courier\Bulk\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Bulk\Traits\InboundBulkMessageUser;
use Courier\Core\Json\JsonProperty;
use Courier\Commons\Types\RecipientPreferences;
use Courier\Send\Types\UserRecipient;

class BulkMessageUserResponse extends JsonSerializableType
{
    use InboundBulkMessageUser;

    /**
     * @var value-of<BulkJobUserStatus> $status
     */
    #[JsonProperty('status')]
    public string $status;

    /**
     * @var ?string $messageId
     */
    #[JsonProperty('messageId')]
    public ?string $messageId;

    /**
     * @param array{
     *   status: value-of<BulkJobUserStatus>,
     *   messageId?: ?string,
     *   preferences?: ?RecipientPreferences,
     *   profile?: mixed,
     *   recipient?: ?string,
     *   data?: mixed,
     *   to?: ?UserRecipient,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->status = $values['status'];
        $this->messageId = $values['messageId'] ?? null;
        $this->preferences = $values['preferences'] ?? null;
        $this->profile = $values['profile'] ?? null;
        $this->recipient = $values['recipient'] ?? null;
        $this->data = $values['data'] ?? null;
        $this->to = $values['to'] ?? null;
    }
}
