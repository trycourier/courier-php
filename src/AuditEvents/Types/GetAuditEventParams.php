<?php

namespace Courier\AuditEvents\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class GetAuditEventParams extends JsonSerializableType
{
    /**
     * @var string $auditEventId
     */
    #[JsonProperty('auditEventId')]
    public string $auditEventId;

    /**
     * @param array{
     *   auditEventId: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->auditEventId = $values['auditEventId'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
