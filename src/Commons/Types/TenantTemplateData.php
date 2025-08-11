<?php

namespace Courier\Commons\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Notifications\Types\MessageRouting;
use Courier\Core\Json\JsonProperty;
use Courier\Send\Types\ElementalContent;

/**
 * The template's data containing it's routing configs and Elemental content
 */
class TenantTemplateData extends JsonSerializableType
{
    /**
     * @var MessageRouting $routing
     */
    #[JsonProperty('routing')]
    public MessageRouting $routing;

    /**
     * @var ElementalContent $content
     */
    #[JsonProperty('content')]
    public ElementalContent $content;

    /**
     * @param array{
     *   routing: MessageRouting,
     *   content: ElementalContent,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->routing = $values['routing'];
        $this->content = $values['content'];
    }
}
