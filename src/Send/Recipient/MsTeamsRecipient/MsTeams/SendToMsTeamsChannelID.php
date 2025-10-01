<?php

declare(strict_types=1);

namespace Courier\Send\Recipient\MsTeamsRecipient\MsTeams;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type send_to_ms_teams_channel_id = array{
 *   serviceURL: string, tenantID: string, channelID: string
 * }
 */
final class SendToMsTeamsChannelID implements BaseModel
{
    /** @use SdkModel<send_to_ms_teams_channel_id> */
    use SdkModel;

    #[Api('service_url')]
    public string $serviceURL;

    #[Api('tenant_id')]
    public string $tenantID;

    #[Api('channel_id')]
    public string $channelID;

    /**
     * `new SendToMsTeamsChannelID()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SendToMsTeamsChannelID::with(serviceURL: ..., tenantID: ..., channelID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SendToMsTeamsChannelID)
     *   ->withServiceURL(...)
     *   ->withTenantID(...)
     *   ->withChannelID(...)
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
        string $channelID
    ): self {
        $obj = new self;

        $obj->serviceURL = $serviceURL;
        $obj->tenantID = $tenantID;
        $obj->channelID = $channelID;

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

    public function withChannelID(string $channelID): self
    {
        $obj = clone $this;
        $obj->channelID = $channelID;

        return $obj;
    }
}
