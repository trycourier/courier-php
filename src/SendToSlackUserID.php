<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type SendToSlackUserIDShape = array{
 *   accessToken: string, userID: string
 * }
 */
final class SendToSlackUserID implements BaseModel
{
    /** @use SdkModel<SendToSlackUserIDShape> */
    use SdkModel;

    #[Required('access_token')]
    public string $accessToken;

    #[Required('user_id')]
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
        $self = new self;

        $self['accessToken'] = $accessToken;
        $self['userID'] = $userID;

        return $self;
    }

    public function withAccessToken(string $accessToken): self
    {
        $self = clone $this;
        $self['accessToken'] = $accessToken;

        return $self;
    }

    public function withUserID(string $userID): self
    {
        $self = clone $this;
        $self['userID'] = $userID;

        return $self;
    }
}
