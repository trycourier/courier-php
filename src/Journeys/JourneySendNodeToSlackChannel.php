<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type JourneySendNodeToSlackChannelShape = array{
 *   channel: string, accessToken?: string|null
 * }
 */
final class JourneySendNodeToSlackChannel implements BaseModel
{
    /** @use SdkModel<JourneySendNodeToSlackChannelShape> */
    use SdkModel;

    /**
     * Slack channel to send to, by name or ID.
     */
    #[Required]
    public string $channel;

    /**
     * A runtime reference to a Slack access token, such as `{{data.slack_token}}`. Literal values are rejected — they'd be stored permanently with no way to rotate them. Omit to use the token on the recipient's stored Slack profile.
     */
    #[Optional('access_token')]
    public ?string $accessToken;

    /**
     * `new JourneySendNodeToSlackChannel()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneySendNodeToSlackChannel::with(channel: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneySendNodeToSlackChannel)->withChannel(...)
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
        string $channel,
        ?string $accessToken = null
    ): self {
        $self = new self;

        $self['channel'] = $channel;

        null !== $accessToken && $self['accessToken'] = $accessToken;

        return $self;
    }

    /**
     * Slack channel to send to, by name or ID.
     */
    public function withChannel(string $channel): self
    {
        $self = clone $this;
        $self['channel'] = $channel;

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
