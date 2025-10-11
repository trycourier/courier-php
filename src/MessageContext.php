<?php

declare(strict_types=1);

namespace Courier;

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
     * Tenant id used to load brand/default preferences/context.
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
     * Tenant id used to load brand/default preferences/context.
     */
    public function withTenantID(?string $tenantID): self
    {
        $obj = clone $this;
        $obj->tenantID = $tenantID;

        return $obj;
    }
}
