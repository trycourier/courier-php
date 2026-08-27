<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type JourneySendNodeToSlackEmailShape = array{
 *   email: string, accessToken?: string|null
 * }
 */
final class JourneySendNodeToSlackEmail implements BaseModel
{
    /** @use SdkModel<JourneySendNodeToSlackEmailShape> */
    use SdkModel;

    /**
     * Email address of the Slack user to send to, resolved via the workspace directory.
     */
    #[Required]
    public string $email;

    /**
     * A runtime reference to a Slack access token, such as `{{data.slack_token}}`. Literal values are rejected — they'd be stored permanently with no way to rotate them. Omit to use the token on the recipient's stored Slack profile.
     */
    #[Optional('access_token')]
    public ?string $accessToken;

    /**
     * `new JourneySendNodeToSlackEmail()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneySendNodeToSlackEmail::with(email: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneySendNodeToSlackEmail)->withEmail(...)
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
    public static function with(string $email, ?string $accessToken = null): self
    {
        $self = new self;

        $self['email'] = $email;

        null !== $accessToken && $self['accessToken'] = $accessToken;

        return $self;
    }

    /**
     * Email address of the Slack user to send to, resolved via the workspace directory.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

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
