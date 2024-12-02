<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Send\Traits\ElementalBaseNode;
use Courier\Core\Json\JsonProperty;

/**
 * The meta element contains information describing the notification that may
 * be used by a particular channel or provider. One important field is the title
 * field which will be used as the title for channels that support it.
 */
class ElementalMetaNode extends JsonSerializableType
{
    use ElementalBaseNode;

    /**
     * @var ?string $title The title to be displayed by supported channels. For example, the email subject.
     */
    #[JsonProperty('title')]
    public ?string $title;

    /**
     * @param array{
     *   title?: ?string,
     *   channels?: ?array<string>,
     *   ref?: ?string,
     *   if?: ?string,
     *   loop?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->title = $values['title'] ?? null;
        $this->channels = $values['channels'] ?? null;
        $this->ref = $values['ref'] ?? null;
        $this->if = $values['if'] ?? null;
        $this->loop = $values['loop'] ?? null;
    }
}
