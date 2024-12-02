<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Profiles\Traits\MsTeamsBaseProperties;
use Courier\Core\Json\JsonProperty;

class SendToMsTeamsConversationId extends JsonSerializableType
{
    use MsTeamsBaseProperties;

    /**
     * @var string $conversationId
     */
    #[JsonProperty('conversation_id')]
    public string $conversationId;

    /**
     * @param array{
     *   conversationId: string,
     *   tenantId: string,
     *   serviceUrl: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->conversationId = $values['conversationId'];
        $this->tenantId = $values['tenantId'];
        $this->serviceUrl = $values['serviceUrl'];
    }
}
