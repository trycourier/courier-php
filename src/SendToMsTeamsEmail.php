<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type SendToMsTeamsEmailShape = array{
 *   email: string, serviceURL: string, tenantID: string
 * }
 */
final class SendToMsTeamsEmail implements BaseModel
{
    /** @use SdkModel<SendToMsTeamsEmailShape> */
    use SdkModel;

    #[Required]
    public string $email;

    #[Required('service_url')]
    public string $serviceURL;

    #[Required('tenant_id')]
    public string $tenantID;

    /**
     * `new SendToMsTeamsEmail()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SendToMsTeamsEmail::with(email: ..., serviceURL: ..., tenantID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SendToMsTeamsEmail)->withEmail(...)->withServiceURL(...)->withTenantID(...)
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
    public static function with(
        string $email,
        string $serviceURL,
        string $tenantID
    ): self {
        $self = new self;

        $self['email'] = $email;
        $self['serviceURL'] = $serviceURL;
        $self['tenantID'] = $tenantID;

        return $self;
    }

    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    public function withServiceURL(string $serviceURL): self
    {
        $self = clone $this;
        $self['serviceURL'] = $serviceURL;

        return $self;
    }

    public function withTenantID(string $tenantID): self
    {
        $self = clone $this;
        $self['tenantID'] = $tenantID;

        return $self;
    }
}
