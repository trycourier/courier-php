<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Profiles\Traits\MsTeamsBaseProperties;
use Courier\Core\Json\JsonProperty;

class SendToMsTeamsEmail extends JsonSerializableType
{
    use MsTeamsBaseProperties;

    /**
     * @var string $email
     */
    #[JsonProperty('email')]
    public string $email;

    /**
     * @param array{
     *   email: string,
     *   tenantId: string,
     *   serviceUrl: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->email = $values['email'];
        $this->tenantId = $values['tenantId'];
        $this->serviceUrl = $values['serviceUrl'];
    }
}
