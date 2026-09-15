<?php

declare(strict_types=1);

namespace Courier\WorkspacePreferences;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Which recipient's held digest to release.
 *
 * @phpstan-type TopicDigestReleaseRequestShape = array{
 *   userID: string, tenantID?: string|null
 * }
 */
final class TopicDigestReleaseRequest implements BaseModel
{
    /** @use SdkModel<TopicDigestReleaseRequestShape> */
    use SdkModel;

    /**
     * The recipient whose digest to release. Required: there is no "release everyone on this topic" form, because a whole-schedule flush already has its own endpoint and a body-shaped difference between one recipient and all of them is too easy to get wrong.
     */
    #[Required('user_id')]
    public string $userID;

    /**
     * The recipient's tenant, when they were sent to as part of one -- the same value returned as `tenant_id` on a digest instance and sent as `message.context.tenant_id`. It is part of the held digest's key, so a tenanted recipient cannot be found without it. Omit for an ordinary recipient.
     */
    #[Optional('tenant_id')]
    public ?string $tenantID;

    /**
     * `new TopicDigestReleaseRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TopicDigestReleaseRequest::with(userID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TopicDigestReleaseRequest)->withUserID(...)
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
    public static function with(string $userID, ?string $tenantID = null): self
    {
        $self = new self;

        $self['userID'] = $userID;

        null !== $tenantID && $self['tenantID'] = $tenantID;

        return $self;
    }

    /**
     * The recipient whose digest to release. Required: there is no "release everyone on this topic" form, because a whole-schedule flush already has its own endpoint and a body-shaped difference between one recipient and all of them is too easy to get wrong.
     */
    public function withUserID(string $userID): self
    {
        $self = clone $this;
        $self['userID'] = $userID;

        return $self;
    }

    /**
     * The recipient's tenant, when they were sent to as part of one -- the same value returned as `tenant_id` on a digest instance and sent as `message.context.tenant_id`. It is part of the held digest's key, so a tenanted recipient cannot be found without it. Omit for an ordinary recipient.
     */
    public function withTenantID(string $tenantID): self
    {
        $self = clone $this;
        $self['tenantID'] = $tenantID;

        return $self;
    }
}
