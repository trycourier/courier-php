<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class MessageProvidersType extends JsonSerializableType
{
    /**
     * @var ?array<string, mixed> $override Provider specific overrides.
     */
    #[JsonProperty('override'), ArrayType(['string' => 'mixed'])]
    public ?array $override;

    /**
     * @var ?string $if A JavaScript conditional expression to determine if the message should be sent
    through the channel. Has access to the data and profile object. For example,
    `data.name === profile.name`
     */
    #[JsonProperty('if')]
    public ?string $if;

    /**
     * @var ?int $timeouts
     */
    #[JsonProperty('timeouts')]
    public ?int $timeouts;

    /**
     * @var ?Metadata $metadata
     */
    #[JsonProperty('metadata')]
    public ?Metadata $metadata;

    /**
     * @param array{
     *   override?: ?array<string, mixed>,
     *   if?: ?string,
     *   timeouts?: ?int,
     *   metadata?: ?Metadata,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->override = $values['override'] ?? null;
        $this->if = $values['if'] ?? null;
        $this->timeouts = $values['timeouts'] ?? null;
        $this->metadata = $values['metadata'] ?? null;
    }
}
