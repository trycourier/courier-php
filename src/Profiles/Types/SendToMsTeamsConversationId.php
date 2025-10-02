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
     *   tenantId: string,
     *   serviceUrl: string,
     *   conversationId: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->tenantId = $values['tenantId'];
        $this->serviceUrl = $values['serviceUrl'];
        $this->conversationId = $values['conversationId'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
