<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type MessageContextShape = array{tenant_id?: string|null}
 */
final class MessageContext implements BaseModel
{
    /** @use SdkModel<MessageContextShape> */
    use SdkModel;

    /**
     * Tenant id used to load brand/default preferences/context.
     */
    #[Optional(nullable: true)]
    public ?string $tenant_id;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $tenant_id = null): self
    {
        $obj = new self;

        null !== $tenant_id && $obj['tenant_id'] = $tenant_id;

        return $obj;
    }

    /**
     * Tenant id used to load brand/default preferences/context.
     */
    public function withTenantID(?string $tenantID): self
    {
        $obj = clone $this;
        $obj['tenant_id'] = $tenantID;

        return $obj;
    }
}
