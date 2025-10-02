<?php

namespace Courier\Commons\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Notifications\Types\MessageRouting;
use Courier\Core\Json\JsonProperty;

/**
 * The template's data containing it's routing configs
 */
class TenantTemplateDataNoContent extends JsonSerializableType
{
    /**
     * @var MessageRouting $routing
     */
    #[JsonProperty('routing')]
    public MessageRouting $routing;

    /**
     * @param array{
     *   routing: MessageRouting,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->routing = $values['routing'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
