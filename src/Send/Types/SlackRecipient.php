<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Profiles\Types\SendToSlackChannel;
use Courier\Profiles\Types\SendToSlackEmail;
use Courier\Profiles\Types\SendToSlackUserId;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\Union;

class SlackRecipient extends JsonSerializableType
{
    /**
     * @var (
     *    SendToSlackChannel
     *   |SendToSlackEmail
     *   |SendToSlackUserId
     * ) $slack
     */
    #[JsonProperty('slack'), Union(SendToSlackChannel::class, SendToSlackEmail::class, SendToSlackUserId::class)]
    public SendToSlackChannel|SendToSlackEmail|SendToSlackUserId $slack;

    /**
     * @param array{
     *   slack: (
     *    SendToSlackChannel
     *   |SendToSlackEmail
     *   |SendToSlackUserId
     * ),
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->slack = $values['slack'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
