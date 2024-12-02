<?php

namespace Courier\Commons\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class UserTenantAssociation extends JsonSerializableType
{
    /**
     * @var ?string $userId User ID for the assocation between tenant and user
     */
    #[JsonProperty('user_id')]
    public ?string $userId;

    /**
     * @var ?string $type
     */
    #[JsonProperty('type')]
    public ?string $type;

    /**
     * @var string $tenantId Tenant ID for the assocation between tenant and user
     */
    #[JsonProperty('tenant_id')]
    public string $tenantId;

    /**
     * @var ?array<string, mixed> $profile Additional metadata to be applied to a user profile when used in a tenant context
     */
    #[JsonProperty('profile'), ArrayType(['string' => 'mixed'])]
    public ?array $profile;

    /**
     * @param array{
     *   userId?: ?string,
     *   type?: ?string,
     *   tenantId: string,
     *   profile?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->userId = $values['userId'] ?? null;
        $this->type = $values['type'] ?? null;
        $this->tenantId = $values['tenantId'];
        $this->profile = $values['profile'] ?? null;
    }
}
