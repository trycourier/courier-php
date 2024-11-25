<?php

namespace Courier\Bulk\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class JobDetails extends JsonSerializableType
{
    /**
     * @var InboundBulkMessage $definition
     */
    #[JsonProperty('definition')]
    public InboundBulkMessage $definition;

    /**
     * @var int $enqueued
     */
    #[JsonProperty('enqueued')]
    public int $enqueued;

    /**
     * @var int $failures
     */
    #[JsonProperty('failures')]
    public int $failures;

    /**
     * @var int $received
     */
    #[JsonProperty('received')]
    public int $received;

    /**
     * @var value-of<BulkJobStatus> $status
     */
    #[JsonProperty('status')]
    public string $status;

    /**
     * @param array{
     *   definition: InboundBulkMessage,
     *   enqueued: int,
     *   failures: int,
     *   received: int,
     *   status: value-of<BulkJobStatus>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->definition = $values['definition'];
        $this->enqueued = $values['enqueued'];
        $this->failures = $values['failures'];
        $this->received = $values['received'];
        $this->status = $values['status'];
    }
}
