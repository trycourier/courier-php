<?php

namespace Courier\Lists\Requests;

use Courier\Core\Json\JsonSerializableType;
use Courier\Lists\Types\PutSubscriptionsRecipient;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class SubscribeUsersToListRequest extends JsonSerializableType
{
    /**
     * @var array<PutSubscriptionsRecipient> $recipients
     */
    #[JsonProperty('recipients'), ArrayType([PutSubscriptionsRecipient::class])]
    public array $recipients;

    /**
     * @param array{
     *   recipients: array<PutSubscriptionsRecipient>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->recipients = $values['recipients'];
    }
}
