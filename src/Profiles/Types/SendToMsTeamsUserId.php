<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Profiles\Traits\MsTeamsBaseProperties;
use Courier\Core\Json\JsonProperty;

class SendToMsTeamsUserId extends JsonSerializableType
{
    use MsTeamsBaseProperties;

    /**
     * @var string $userId
     */
    #[JsonProperty('user_id')]
    public string $userId;

    /**
     * @param array{
     *   userId: string,
     *   tenantId: string,
     *   serviceUrl: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->userId = $values['userId'];
        $this->tenantId = $values['tenantId'];
        $this->serviceUrl = $values['serviceUrl'];
    }
}
