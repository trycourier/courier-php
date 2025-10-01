<?php

declare(strict_types=1);

namespace Courier\Send\Recipient\SlackRecipient\Slack;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type send_to_slack_channel = array{
 *   accessToken: string, channel: string
 * }
 */
final class SendToSlackChannel implements BaseModel
{
    /** @use SdkModel<send_to_slack_channel> */
    use SdkModel;

    #[Api('access_token')]
    public string $accessToken;

    #[Api]
    public string $channel;

    /**
     * `new SendToSlackChannel()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SendToSlackChannel::with(accessToken: ..., channel: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SendToSlackChannel)->withAccessToken(...)->withChannel(...)
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
    public static function with(string $accessToken, string $channel): self
    {
        $obj = new self;

        $obj->accessToken = $accessToken;
        $obj->channel = $channel;

        return $obj;
    }

    public function withAccessToken(string $accessToken): self
    {
        $obj = clone $this;
        $obj->accessToken = $accessToken;

        return $obj;
    }

    public function withChannel(string $channel): self
    {
        $obj = clone $this;
        $obj->channel = $channel;

        return $obj;
    }
}
