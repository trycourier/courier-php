<?php

namespace Courier\Users\Tenants\Requests;

use Courier\Core\Json\JsonSerializableType;
use Courier\Commons\Types\UserTenantAssociation;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class AddUserToMultipleTenantsParams extends JsonSerializableType
{
    /**
     * @var array<UserTenantAssociation> $tenants
     */
    #[JsonProperty('tenants'), ArrayType([UserTenantAssociation::class])]
    public array $tenants;

    /**
     * @param array{
     *   tenants: array<UserTenantAssociation>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->tenants = $values['tenants'];
    }
}
