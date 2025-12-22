<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type SendToMsTeamsChannelNameShape = array{
 *   channelName: string, serviceURL: string, teamID: string, tenantID: string
 * }
 */
final class SendToMsTeamsChannelName implements BaseModel
{
    /** @use SdkModel<SendToMsTeamsChannelNameShape> */
    use SdkModel;

    #[Required('channel_name')]
    public string $channelName;

    #[Required('service_url')]
    public string $serviceURL;

    #[Required('team_id')]
    public string $teamID;

    #[Required('tenant_id')]
    public string $tenantID;

    /**
     * `new SendToMsTeamsChannelName()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SendToMsTeamsChannelName::with(
     *   channelName: ..., serviceURL: ..., teamID: ..., tenantID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SendToMsTeamsChannelName)
     *   ->withChannelName(...)
     *   ->withServiceURL(...)
     *   ->withTeamID(...)
     *   ->withTenantID(...)
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
        string $channelName,
        string $serviceURL,
        string $teamID,
        string $tenantID
    ): self {
        $self = new self;

        $self['channelName'] = $channelName;
        $self['serviceURL'] = $serviceURL;
        $self['teamID'] = $teamID;
        $self['tenantID'] = $tenantID;

        return $self;
    }

    public function withChannelName(string $channelName): self
    {
        $self = clone $this;
        $self['channelName'] = $channelName;

        return $self;
    }

    public function withServiceURL(string $serviceURL): self
    {
        $self = clone $this;
        $self['serviceURL'] = $serviceURL;

        return $self;
    }

    public function withTeamID(string $teamID): self
    {
        $self = clone $this;
        $self['teamID'] = $teamID;

        return $self;
    }

    public function withTenantID(string $tenantID): self
    {
        $self = clone $this;
        $self['tenantID'] = $tenantID;

        return $self;
    }
}
