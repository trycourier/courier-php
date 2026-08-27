<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Sends directly to a Microsoft Teams channel by its Bot Framework ID. Still provide at least one of `tenant_id` or `service_url` — sends without either have failed Bot Framework authentication in testing.
 *
 * @phpstan-type SendToMsTeamsChannelIDShape = array{
 *   channelID: string, serviceURL?: string|null, tenantID?: string|null
 * }
 */
final class SendToMsTeamsChannelID implements BaseModel
{
    /** @use SdkModel<SendToMsTeamsChannelIDShape> */
    use SdkModel;

    #[Required('channel_id')]
    public string $channelID;

    #[Optional('service_url')]
    public ?string $serviceURL;

    #[Optional('tenant_id')]
    public ?string $tenantID;

    /**
     * `new SendToMsTeamsChannelID()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SendToMsTeamsChannelID::with(channelID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SendToMsTeamsChannelID)->withChannelID(...)
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
        string $channelID,
        ?string $serviceURL = null,
        ?string $tenantID = null
    ): self {
        $self = new self;

        $self['channelID'] = $channelID;

        null !== $serviceURL && $self['serviceURL'] = $serviceURL;
        null !== $tenantID && $self['tenantID'] = $tenantID;

        return $self;
    }

    public function withChannelID(string $channelID): self
    {
        $self = clone $this;
        $self['channelID'] = $channelID;

        return $self;
    }

    public function withServiceURL(string $serviceURL): self
    {
        $self = clone $this;
        $self['serviceURL'] = $serviceURL;

        return $self;
    }

    public function withTenantID(string $tenantID): self
    {
        $self = clone $this;
        $self['tenantID'] = $tenantID;

        return $self;
    }
}
