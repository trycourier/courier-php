<?php

namespace Courier\Bulk\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Commons\Types\RecipientPreferences;
use Courier\Core\Json\JsonProperty;
use Courier\Send\Types\UserRecipient;

class InboundBulkMessageUser extends JsonSerializableType
{
    /**
     * @var ?RecipientPreferences $preferences
     */
    #[JsonProperty('preferences')]
    public ?RecipientPreferences $preferences;

    /**
     * @var mixed $profile
     */
    #[JsonProperty('profile')]
    public mixed $profile;

    /**
     * @var ?string $recipient
     */
    #[JsonProperty('recipient')]
    public ?string $recipient;

    /**
     * @var mixed $data
     */
    #[JsonProperty('data')]
    public mixed $data;

    /**
     * @var ?UserRecipient $to
     */
    #[JsonProperty('to')]
    public ?UserRecipient $to;

    /**
     * @param array{
     *   preferences?: ?RecipientPreferences,
     *   profile?: mixed,
     *   recipient?: ?string,
     *   data?: mixed,
     *   to?: ?UserRecipient,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->preferences = $values['preferences'] ?? null;
        $this->profile = $values['profile'] ?? null;
        $this->recipient = $values['recipient'] ?? null;
        $this->data = $values['data'] ?? null;
        $this->to = $values['to'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
