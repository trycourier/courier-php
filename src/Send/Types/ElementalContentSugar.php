<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

/**
 * Syntatic Sugar to provide a fast shorthand for Courier Elemental Blocks.
 */
class ElementalContentSugar extends JsonSerializableType
{
    /**
     * @var string $title The title to be displayed by supported channels i.e. push, email (as subject)
     */
    #[JsonProperty('title')]
    public string $title;

    /**
     * @var string $body The text content displayed in the notification.
     */
    #[JsonProperty('body')]
    public string $body;

    /**
     * @param array{
     *   title: string,
     *   body: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->title = $values['title'];
        $this->body = $values['body'];
    }
}
