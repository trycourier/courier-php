<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class AudienceRecipient extends JsonSerializableType
{
    /**
     * @var string $audienceId A unique identifier associated with an Audience. A message will be sent to each user in the audience.
     */
    #[JsonProperty('audience_id')]
    public string $audienceId;

    /**
     * @var ?array<string, mixed> $data
     */
    #[JsonProperty('data'), ArrayType(['string' => 'mixed'])]
    public ?array $data;

    /**
     * @var ?array<AudienceFilter> $filters
     */
    #[JsonProperty('filters'), ArrayType([AudienceFilter::class])]
    public ?array $filters;

    /**
     * @param array{
     *   audienceId: string,
     *   data?: ?array<string, mixed>,
     *   filters?: ?array<AudienceFilter>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->audienceId = $values['audienceId'];
        $this->data = $values['data'] ?? null;
        $this->filters = $values['filters'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
