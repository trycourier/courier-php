<?php

namespace Courier\Bulk\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class BulkGetJobParams extends JsonSerializableType
{
    /**
     * @var string $jobId
     */
    #[JsonProperty('jobId')]
    public string $jobId;

    /**
     * @param array{
     *   jobId: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->jobId = $values['jobId'];
    }
}
