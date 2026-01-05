<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type SendToSlackChannelShape = array{
 *   accessToken: string, channel: string
 * }
 */
final class SendToSlackChannel implements BaseModel
{
    /** @use SdkModel<SendToSlackChannelShape> */
    use SdkModel;

    #[Required('access_token')]
    public string $accessToken;

    #[Required]
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
        $self = new self;

        $self['accessToken'] = $accessToken;
        $self['channel'] = $channel;

        return $self;
    }

    public function withAccessToken(string $accessToken): self
    {
        $self = clone $this;
        $self['accessToken'] = $accessToken;

        return $self;
    }

    public function withChannel(string $channel): self
    {
        $self = clone $this;
        $self['channel'] = $channel;

        return $self;
    }
}
