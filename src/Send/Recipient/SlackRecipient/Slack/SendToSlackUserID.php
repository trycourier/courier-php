<?php

declare(strict_types=1);

namespace Courier\Send\Recipient\SlackRecipient\Slack;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type send_to_slack_user_id = array{accessToken: string, userID: string}
 */
final class SendToSlackUserID implements BaseModel
{
    /** @use SdkModel<send_to_slack_user_id> */
    use SdkModel;

    #[Api('access_token')]
    public string $accessToken;

    #[Api('user_id')]
    public string $userID;

    /**
     * `new SendToSlackUserID()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SendToSlackUserID::with(accessToken: ..., userID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SendToSlackUserID)->withAccessToken(...)->withUserID(...)
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
    public static function with(string $accessToken, string $userID): self
    {
        $obj = new self;

        $obj->accessToken = $accessToken;
        $obj->userID = $userID;

        return $obj;
    }

    public function withAccessToken(string $accessToken): self
    {
        $obj = clone $this;
        $obj->accessToken = $accessToken;

        return $obj;
    }

    public function withUserID(string $userID): self
    {
        $obj = clone $this;
        $obj->userID = $userID;

        return $obj;
    }
}
