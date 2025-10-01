<?php

declare(strict_types=1);

namespace Courier\Send\Recipient\MsTeamsRecipient\MsTeams;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type send_to_ms_teams_user_id = array{
 *   serviceURL: string, tenantID: string, userID: string
 * }
 */
final class SendToMsTeamsUserID implements BaseModel
{
    /** @use SdkModel<send_to_ms_teams_user_id> */
    use SdkModel;

    #[Api('service_url')]
    public string $serviceURL;

    #[Api('tenant_id')]
    public string $tenantID;

    #[Api('user_id')]
    public string $userID;

    /**
     * `new SendToMsTeamsUserID()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SendToMsTeamsUserID::with(serviceURL: ..., tenantID: ..., userID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SendToMsTeamsUserID)
     *   ->withServiceURL(...)
     *   ->withTenantID(...)
     *   ->withUserID(...)
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
        string $userID
    ): self {
        $obj = new self;

        $obj->serviceURL = $serviceURL;
        $obj->tenantID = $tenantID;
        $obj->userID = $userID;

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

    public function withUserID(string $userID): self
    {
        $obj = clone $this;
        $obj->userID = $userID;

        return $obj;
    }
}
