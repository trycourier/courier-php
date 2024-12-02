<?php

namespace Courier\Bulk\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class BulkIngestError extends JsonSerializableType
{
    /**
     * @var mixed $user
     */
    #[JsonProperty('user')]
    public mixed $user;

    /**
     * @var mixed $error
     */
    #[JsonProperty('error')]
    public mixed $error;

    /**
     * @param array{
     *   user: mixed,
     *   error: mixed,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->user = $values['user'];
        $this->error = $values['error'];
    }
}
