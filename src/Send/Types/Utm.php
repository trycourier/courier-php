<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class Utm extends JsonSerializableType
{
    /**
     * @var ?string $source
     */
    #[JsonProperty('source')]
    public ?string $source;

    /**
     * @var ?string $medium
     */
    #[JsonProperty('medium')]
    public ?string $medium;

    /**
     * @var ?string $campaign
     */
    #[JsonProperty('campaign')]
    public ?string $campaign;

    /**
     * @var ?string $term
     */
    #[JsonProperty('term')]
    public ?string $term;

    /**
     * @var ?string $content
     */
    #[JsonProperty('content')]
    public ?string $content;

    /**
     * @param array{
     *   source?: ?string,
     *   medium?: ?string,
     *   campaign?: ?string,
     *   term?: ?string,
     *   content?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->source = $values['source'] ?? null;
        $this->medium = $values['medium'] ?? null;
        $this->campaign = $values['campaign'] ?? null;
        $this->term = $values['term'] ?? null;
        $this->content = $values['content'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
