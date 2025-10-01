<?php

declare(strict_types=1);

namespace Courier\Send\BaseMessageSendTo\To\SlackRecipient\Slack;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type send_to_slack_email = array{accessToken: string, email: string}
 */
final class SendToSlackEmail implements BaseModel
{
    /** @use SdkModel<send_to_slack_email> */
    use SdkModel;

    #[Api('access_token')]
    public string $accessToken;

    #[Api]
    public string $email;

    /**
     * `new SendToSlackEmail()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SendToSlackEmail::with(accessToken: ..., email: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SendToSlackEmail)->withAccessToken(...)->withEmail(...)
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
    public static function with(string $accessToken, string $email): self
    {
        $obj = new self;

        $obj->accessToken = $accessToken;
        $obj->email = $email;

        return $obj;
    }

    public function withAccessToken(string $accessToken): self
    {
        $obj = clone $this;
        $obj->accessToken = $accessToken;

        return $obj;
    }

    public function withEmail(string $email): self
    {
        $obj = clone $this;
        $obj->email = $email;

        return $obj;
    }
}
