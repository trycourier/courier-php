<?php

namespace Courier\Audiences\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class AudienceMemberGetResponse extends JsonSerializableType
{
    /**
     * @var AudienceMember $audienceMember
     */
    #[JsonProperty('audienceMember')]
    public AudienceMember $audienceMember;

    /**
     * @param array{
     *   audienceMember: AudienceMember,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->audienceMember = $values['audienceMember'];
    }
}
