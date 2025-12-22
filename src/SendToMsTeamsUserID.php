<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type SendToMsTeamsUserIDShape = array{
 *   serviceURL: string, tenantID: string, userID: string
 * }
 */
final class SendToMsTeamsUserID implements BaseModel
{
    /** @use SdkModel<SendToMsTeamsUserIDShape> */
    use SdkModel;

    #[Required('service_url')]
    public string $serviceURL;

    #[Required('tenant_id')]
    public string $tenantID;

    #[Required('user_id')]
    public string $userID;

    /**
     * `new SendToMsTeamsUserID()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SendToMsTeamsUserID::with(serviceURL: ..., tenantID: ..., userID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SendToMsTeamsUserID)
     *   ->withServiceURL(...)
     *   ->withTenantID(...)
     *   ->withUserID(...)
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
        string $serviceURL,
        string $tenantID,
        string $userID
    ): self {
        $self = new self;

        $self['serviceURL'] = $serviceURL;
        $self['tenantID'] = $tenantID;
        $self['userID'] = $userID;

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

    public function withUserID(string $userID): self
    {
        $self = clone $this;
        $self['userID'] = $userID;

        return $self;
    }
}
