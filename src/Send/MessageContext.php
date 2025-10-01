<?php

declare(strict_types=1);

namespace Courier\Send;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type message_context = array{tenantID?: string|null}
 */
final class MessageContext implements BaseModel
{
    /** @use SdkModel<message_context> */
    use SdkModel;

    /**
     * An id of a tenant, see [tenants api docs](https://www.courier.com/docs/reference/tenants/).
     * Will load brand, default preferences and any other base context data associated with this tenant.
     */
    #[Api('tenant_id', nullable: true, optional: true)]
    public ?string $tenantID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $tenantID = null): self
    {
        $obj = new self;

        null !== $tenantID && $obj->tenantID = $tenantID;

        return $obj;
    }

    /**
     * An id of a tenant, see [tenants api docs](https://www.courier.com/docs/reference/tenants/).
     * Will load brand, default preferences and any other base context data associated with this tenant.
     */
    public function withTenantID(?string $tenantID): self
    {
        $obj = clone $this;
        $obj->tenantID = $tenantID;

        return $obj;
    }
}
