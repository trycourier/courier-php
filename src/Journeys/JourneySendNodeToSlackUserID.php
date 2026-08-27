<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type JourneySendNodeToSlackUserIDShape = array{
 *   userID: string, accessToken?: string|null
 * }
 */
final class JourneySendNodeToSlackUserID implements BaseModel
{
    /** @use SdkModel<JourneySendNodeToSlackUserIDShape> */
    use SdkModel;

    /**
     * Slack user ID to send to.
     */
    #[Required('user_id')]
    public string $userID;

    /**
     * A runtime reference to a Slack access token, such as `{{data.slack_token}}`. Literal values are rejected — they'd be stored permanently with no way to rotate them. Omit to use the token on the recipient's stored Slack profile.
     */
    #[Optional('access_token')]
    public ?string $accessToken;

    /**
     * `new JourneySendNodeToSlackUserID()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneySendNodeToSlackUserID::with(userID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneySendNodeToSlackUserID)->withUserID(...)
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
        string $userID,
        ?string $accessToken = null
    ): self {
        $self = new self;

        $self['userID'] = $userID;

        null !== $accessToken && $self['accessToken'] = $accessToken;

        return $self;
    }

    /**
     * Slack user ID to send to.
     */
    public function withUserID(string $userID): self
    {
        $self = clone $this;
        $self['userID'] = $userID;

        return $self;
    }

    /**
     * A runtime reference to a Slack access token, such as `{{data.slack_token}}`. Literal values are rejected — they'd be stored permanently with no way to rotate them. Omit to use the token on the recipient's stored Slack profile.
     */
    public function withAccessToken(string $accessToken): self
    {
        $self = clone $this;
        $self['accessToken'] = $accessToken;

        return $self;
    }
}
