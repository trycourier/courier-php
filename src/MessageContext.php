<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type MessageContextShape = array{tenantID?: string|null}
 */
final class MessageContext implements BaseModel
{
    /** @use SdkModel<MessageContextShape> */
    use SdkModel;

    /**
     * Tenant id used to load brand/default preferences/context.
     */
    #[Optional('tenant_id', nullable: true)]
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
        $self = new self;

        null !== $tenantID && $self['tenantID'] = $tenantID;

        return $self;
    }

    /**
     * Tenant id used to load brand/default preferences/context.
     */
    public function withTenantID(?string $tenantID): self
    {
        $self = clone $this;
        $self['tenantID'] = $tenantID;

        return $self;
    }
}
