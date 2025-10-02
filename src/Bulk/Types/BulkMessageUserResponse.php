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
     *   preferences?: ?RecipientPreferences,
     *   profile?: mixed,
     *   recipient?: ?string,
     *   data?: mixed,
     *   to?: ?UserRecipient,
     *   messageId?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->preferences = $values['preferences'] ?? null;
        $this->profile = $values['profile'] ?? null;
        $this->recipient = $values['recipient'] ?? null;
        $this->data = $values['data'] ?? null;
        $this->to = $values['to'] ?? null;
        $this->status = $values['status'];
        $this->messageId = $values['messageId'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
