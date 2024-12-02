<?php

namespace Courier\Commons\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class Email extends JsonSerializableType
{
    /**
     * @var mixed $footer
     */
    #[JsonProperty('footer')]
    public mixed $footer;

    /**
     * @var mixed $header
     */
    #[JsonProperty('header')]
    public mixed $header;

    /**
     * @param array{
     *   footer: mixed,
     *   header: mixed,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->footer = $values['footer'];
        $this->header = $values['header'];
    }
}
