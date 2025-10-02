<?php

namespace Courier\Bulk\Traits;

use Courier\Commons\Types\RecipientPreferences;
use Courier\Send\Types\UserRecipient;
use Courier\Core\Json\JsonProperty;

/**
 * @property ?RecipientPreferences $preferences
 * @property mixed $profile
 * @property ?string $recipient
 * @property mixed $data
 * @property ?UserRecipient $to
 */
trait InboundBulkMessageUser
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
}
