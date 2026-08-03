<?php

declare(strict_types=1);

namespace Courier\Journeys\JourneySendNode\Message;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Tenant context for this send. Set it to deliver on behalf of one of your customers, so the message uses that tenant's brand and settings.
 *
 * @phpstan-type ContextShape = array{tenantID: string}
 */
final class Context implements BaseModel
{
    /** @use SdkModel<ContextShape> */
    use SdkModel;

    /**
     * The tenant to send as. Accepts either a literal tenant id (`acme-tenant`) or a whole-string mustache reference to a value the run already holds — `{{data.tenant_id}}` from the invocation payload, or `{{f1.body.tenant_id}}` from the response of an earlier fetch node with id `f1`. A reference is resolved separately on every run, so a single journey can deliver as many tenants. Two forms are rejected with `400`: mid-string interpolation such as `tenant-{{data.region}}`, and any value beginning with `refs.`, which is reserved for internal use. A reference that resolves to nothing at run time does not stop the run — the message is still sent, with no tenant context — so make sure the referenced value is always present. `GET` returns the value in the same form it was supplied.
     */
    #[Required('tenant_id')]
    public string $tenantID;

    /**
     * `new Context()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Context::with(tenantID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Context)->withTenantID(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $tenantID): self
    {
        $self = new self;

        $self['tenantID'] = $tenantID;

        return $self;
    }

    /**
     * The tenant to send as. Accepts either a literal tenant id (`acme-tenant`) or a whole-string mustache reference to a value the run already holds — `{{data.tenant_id}}` from the invocation payload, or `{{f1.body.tenant_id}}` from the response of an earlier fetch node with id `f1`. A reference is resolved separately on every run, so a single journey can deliver as many tenants. Two forms are rejected with `400`: mid-string interpolation such as `tenant-{{data.region}}`, and any value beginning with `refs.`, which is reserved for internal use. A reference that resolves to nothing at run time does not stop the run — the message is still sent, with no tenant context — so make sure the referenced value is always present. `GET` returns the value in the same form it was supplied.
     */
    public function withTenantID(string $tenantID): self
    {
        $self = clone $this;
        $self['tenantID'] = $tenantID;

        return $self;
    }
}
