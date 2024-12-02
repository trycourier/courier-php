<?php

namespace Courier\Notifications\Requests;

use Courier\Core\Json\JsonSerializableType;
use Courier\Notifications\Types\BaseCheck;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class SubmissionChecksReplaceParams extends JsonSerializableType
{
    /**
     * @var array<BaseCheck> $checks
     */
    #[JsonProperty('checks'), ArrayType([BaseCheck::class])]
    public array $checks;

    /**
     * @param array{
     *   checks: array<BaseCheck>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->checks = $values['checks'];
    }
}
