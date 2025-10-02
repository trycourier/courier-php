<?php

namespace Courier\Users\Tokens\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Users\Tokens\Traits\UserToken;
use Courier\Core\Json\JsonProperty;

class GetUserTokenResponse extends JsonSerializableType
{
    use UserToken;

    /**
     * @var ?value-of<TokenStatus> $status
     */
    #[JsonProperty('status')]
    public ?string $status;

    /**
     * @var ?string $statusReason The reason for the token status.
     */
    #[JsonProperty('status_reason')]
    public ?string $statusReason;

    /**
     * @param array{
     *   providerKey: value-of<ProviderKey>,
     *   token?: ?string,
     *   expiryDate?: (
     *    string
     *   |bool
     * )|null,
     *   properties?: mixed,
     *   device?: ?Device,
     *   tracking?: ?Tracking,
     *   status?: ?value-of<TokenStatus>,
     *   statusReason?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->token = $values['token'] ?? null;
        $this->providerKey = $values['providerKey'];
        $this->expiryDate = $values['expiryDate'] ?? null;
        $this->properties = $values['properties'] ?? null;
        $this->device = $values['device'] ?? null;
        $this->tracking = $values['tracking'] ?? null;
        $this->status = $values['status'] ?? null;
        $this->statusReason = $values['statusReason'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
