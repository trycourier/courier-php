<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type SendToMsTeamsConversationIDShape = array{
 *   conversationID: string, serviceURL: string, tenantID: string
 * }
 */
final class SendToMsTeamsConversationID implements BaseModel
{
    /** @use SdkModel<SendToMsTeamsConversationIDShape> */
    use SdkModel;

    #[Required('conversation_id')]
    public string $conversationID;

    #[Required('service_url')]
    public string $serviceURL;

    #[Required('tenant_id')]
    public string $tenantID;

    /**
     * `new SendToMsTeamsConversationID()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SendToMsTeamsConversationID::with(
     *   conversationID: ..., serviceURL: ..., tenantID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SendToMsTeamsConversationID)
     *   ->withConversationID(...)
     *   ->withServiceURL(...)
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
        string $conversationID,
        string $serviceURL,
        string $tenantID
    ): self {
        $self = new self;

        $self['conversationID'] = $conversationID;
        $self['serviceURL'] = $serviceURL;
        $self['tenantID'] = $tenantID;

        return $self;
    }

    public function withConversationID(string $conversationID): self
    {
        $self = clone $this;
        $self['conversationID'] = $conversationID;

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
