<?php

namespace Courier\AuthTokens\Requests;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class IssueTokenParams extends JsonSerializableType
{
    /**
     * @var string $scope
     */
    #[JsonProperty('scope')]
    public string $scope;

    /**
     * @var string $expiresIn
     */
    #[JsonProperty('expires_in')]
    public string $expiresIn;

    /**
     * @param array{
     *   scope: string,
     *   expiresIn: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->scope = $values['scope'];
        $this->expiresIn = $values['expiresIn'];
    }
}
