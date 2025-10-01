<?php

declare(strict_types=1);

namespace Courier\Send\BaseMessageSendTo\To\MsTeamsRecipient\MsTeams;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type send_to_ms_teams_conversation_id = array{
 *   serviceURL: string, tenantID: string, conversationID: string
 * }
 */
final class SendToMsTeamsConversationID implements BaseModel
{
    /** @use SdkModel<send_to_ms_teams_conversation_id> */
    use SdkModel;

    #[Api('service_url')]
    public string $serviceURL;

    #[Api('tenant_id')]
    public string $tenantID;

    #[Api('conversation_id')]
    public string $conversationID;

    /**
     * `new SendToMsTeamsConversationID()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SendToMsTeamsConversationID::with(
     *   serviceURL: ..., tenantID: ..., conversationID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SendToMsTeamsConversationID)
     *   ->withServiceURL(...)
     *   ->withTenantID(...)
     *   ->withConversationID(...)
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
        string $conversationID
    ): self {
        $obj = new self;

        $obj->serviceURL = $serviceURL;
        $obj->tenantID = $tenantID;
        $obj->conversationID = $conversationID;

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

    public function withConversationID(string $conversationID): self
    {
        $obj = clone $this;
        $obj->conversationID = $conversationID;

        return $obj;
    }
}
