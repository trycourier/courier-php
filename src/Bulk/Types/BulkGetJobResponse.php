<?php

namespace Courier\Bulk\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class BulkGetJobResponse extends JsonSerializableType
{
    /**
     * @var JobDetails $job
     */
    #[JsonProperty('job')]
    public JobDetails $job;

    /**
     * @param array{
     *   job: JobDetails,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->job = $values['job'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
