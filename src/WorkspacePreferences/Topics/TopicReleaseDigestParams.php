<?php

declare(strict_types=1);

namespace Courier\WorkspacePreferences\Topics;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Send one recipient's held digest now, instead of waiting for its schedule. Use it to preview what a digest will look like, or to let someone flush their own.
 *
 * Keyed on the topic because that is how a held digest is stored: one per recipient per topic, with the schedule recorded on it rather than part of its identity. To flush every recipient on a schedule instead, use `POST /digests/schedules/{schedule_id}/trigger`.
 *
 * @see Courier\Services\WorkspacePreferences\TopicsService::releaseDigest()
 *
 * @phpstan-type TopicReleaseDigestParamsShape = array{
 *   sectionID: string, userID: string, tenantID?: string|null
 * }
 */
final class TopicReleaseDigestParams implements BaseModel
{
    /** @use SdkModel<TopicReleaseDigestParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $sectionID;

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
     * `new TopicReleaseDigestParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TopicReleaseDigestParams::with(sectionID: ..., userID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TopicReleaseDigestParams)->withSectionID(...)->withUserID(...)
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
        string $sectionID,
        string $userID,
        ?string $tenantID = null
    ): self {
        $self = new self;

        $self['sectionID'] = $sectionID;
        $self['userID'] = $userID;

        null !== $tenantID && $self['tenantID'] = $tenantID;

        return $self;
    }

    public function withSectionID(string $sectionID): self
    {
        $self = clone $this;
        $self['sectionID'] = $sectionID;

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
