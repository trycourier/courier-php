<?php

namespace Courier\Audiences\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class AudienceMember extends JsonSerializableType
{
    /**
     * @var string $addedAt
     */
    #[JsonProperty('added_at')]
    public string $addedAt;

    /**
     * @var string $audienceId
     */
    #[JsonProperty('audience_id')]
    public string $audienceId;

    /**
     * @var int $audienceVersion
     */
    #[JsonProperty('audience_version')]
    public int $audienceVersion;

    /**
     * @var string $memberId
     */
    #[JsonProperty('member_id')]
    public string $memberId;

    /**
     * @var string $reason
     */
    #[JsonProperty('reason')]
    public string $reason;

    /**
     * @param array{
     *   addedAt: string,
     *   audienceId: string,
     *   audienceVersion: int,
     *   memberId: string,
     *   reason: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->addedAt = $values['addedAt'];
        $this->audienceId = $values['audienceId'];
        $this->audienceVersion = $values['audienceVersion'];
        $this->memberId = $values['memberId'];
        $this->reason = $values['reason'];
    }
}
