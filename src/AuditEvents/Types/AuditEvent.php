<?php

namespace Courier\AuditEvents\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class AuditEvent extends JsonSerializableType
{
    /**
     * @var ?Actor $actor
     */
    #[JsonProperty('actor')]
    public ?Actor $actor;

    /**
     * @var ?Target $target
     */
    #[JsonProperty('target')]
    public ?Target $target;

    /**
     * @var string $auditEventId
     */
    #[JsonProperty('auditEventId')]
    public string $auditEventId;

    /**
     * @var string $source
     */
    #[JsonProperty('source')]
    public string $source;

    /**
     * @var string $timestamp
     */
    #[JsonProperty('timestamp')]
    public string $timestamp;

    /**
     * @var string $type
     */
    #[JsonProperty('type')]
    public string $type;

    /**
     * @param array{
     *   actor?: ?Actor,
     *   target?: ?Target,
     *   auditEventId: string,
     *   source: string,
     *   timestamp: string,
     *   type: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->actor = $values['actor'] ?? null;
        $this->target = $values['target'] ?? null;
        $this->auditEventId = $values['auditEventId'];
        $this->source = $values['source'];
        $this->timestamp = $values['timestamp'];
        $this->type = $values['type'];
    }
}
