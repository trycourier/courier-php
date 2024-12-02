<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class MessageContext extends JsonSerializableType
{
    /**
     * @var ?string $tenantId An id of a tenant, see [tenants api docs](https://www.courier.com/docs/reference/tenants/).
    Will load brand, default preferences and any other base context data associated with this tenant.
     */
    #[JsonProperty('tenant_id')]
    public ?string $tenantId;

    /**
     * @param array{
     *   tenantId?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->tenantId = $values['tenantId'] ?? null;
    }
}
