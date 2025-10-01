<?php

declare(strict_types=1);

namespace Courier\Send\Recipient\MsTeamsRecipient\MsTeams;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type send_to_ms_teams_email = array{
 *   serviceURL: string, tenantID: string, email: string
 * }
 */
final class SendToMsTeamsEmail implements BaseModel
{
    /** @use SdkModel<send_to_ms_teams_email> */
    use SdkModel;

    #[Api('service_url')]
    public string $serviceURL;

    #[Api('tenant_id')]
    public string $tenantID;

    #[Api]
    public string $email;

    /**
     * `new SendToMsTeamsEmail()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SendToMsTeamsEmail::with(serviceURL: ..., tenantID: ..., email: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SendToMsTeamsEmail)->withServiceURL(...)->withTenantID(...)->withEmail(...)
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
        string $email
    ): self {
        $obj = new self;

        $obj->serviceURL = $serviceURL;
        $obj->tenantID = $tenantID;
        $obj->email = $email;

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

    public function withEmail(string $email): self
    {
        $obj = clone $this;
        $obj->email = $email;

        return $obj;
    }
}
