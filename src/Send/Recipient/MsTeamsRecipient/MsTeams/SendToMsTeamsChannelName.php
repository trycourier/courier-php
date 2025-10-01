<?php

declare(strict_types=1);

namespace Courier\Send\Recipient\MsTeamsRecipient\MsTeams;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type send_to_ms_teams_channel_name = array{
 *   serviceURL: string, tenantID: string, channelName: string, teamID: string
 * }
 */
final class SendToMsTeamsChannelName implements BaseModel
{
    /** @use SdkModel<send_to_ms_teams_channel_name> */
    use SdkModel;

    #[Api('service_url')]
    public string $serviceURL;

    #[Api('tenant_id')]
    public string $tenantID;

    #[Api('channel_name')]
    public string $channelName;

    #[Api('team_id')]
    public string $teamID;

    /**
     * `new SendToMsTeamsChannelName()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SendToMsTeamsChannelName::with(
     *   serviceURL: ..., tenantID: ..., channelName: ..., teamID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SendToMsTeamsChannelName)
     *   ->withServiceURL(...)
     *   ->withTenantID(...)
     *   ->withChannelName(...)
     *   ->withTeamID(...)
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
        string $serviceURL,
        string $tenantID,
        string $channelName,
        string $teamID
    ): self {
        $obj = new self;

        $obj->serviceURL = $serviceURL;
        $obj->tenantID = $tenantID;
        $obj->channelName = $channelName;
        $obj->teamID = $teamID;

        return $obj;
    }

    public function withServiceURL(string $serviceURL): self
    {
        $obj = clone $this;
        $obj->serviceURL = $serviceURL;

        return $obj;
    }

    public function withTenantID(string $tenantID): self
    {
        $obj = clone $this;
        $obj->tenantID = $tenantID;

        return $obj;
    }

    public function withChannelName(string $channelName): self
    {
        $obj = clone $this;
        $obj->channelName = $channelName;

        return $obj;
    }

    public function withTeamID(string $teamID): self
    {
        $obj = clone $this;
        $obj->teamID = $teamID;

        return $obj;
    }
}
