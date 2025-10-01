<?php

declare(strict_types=1);

namespace Courier\Send\BaseMessageSendTo\To;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\BaseMessageSendTo\To\SlackRecipient\Slack\SendToSlackChannel;
use Courier\Send\BaseMessageSendTo\To\SlackRecipient\Slack\SendToSlackEmail;
use Courier\Send\BaseMessageSendTo\To\SlackRecipient\Slack\SendToSlackUserID;

/**
 * @phpstan-type slack_recipient = array{
 *   slack: send_to_slack_channel|send_to_slack_email|send_to_slack_user_id
 * }
 */
final class SlackRecipient implements BaseModel
{
    /** @use SdkModel<slack_recipient> */
    use SdkModel;

    #[Api]
    public SendToSlackChannel|SendToSlackEmail|SendToSlackUserID $slack;

    /**
     * `new SlackRecipient()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SlackRecipient::with(slack: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SlackRecipient)->withSlack(...)
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
        SendToSlackChannel|SendToSlackEmail|SendToSlackUserID $slack
    ): self {
        $obj = new self;

        $obj->slack = $slack;

        return $obj;
    }

    public function withSlack(
        SendToSlackChannel|SendToSlackEmail|SendToSlackUserID $slack
    ): self {
        $obj = clone $this;
        $obj->slack = $slack;

        return $obj;
    }
}
