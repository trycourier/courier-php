<?php

declare(strict_types=1);

namespace Courier\WorkspacePreferences;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Returns the history of preference changes in this environment, newest first. Each entry records one change a user made to one subscription topic, and carries the value before it where there was one. Supply user_id to read a single user's history instead of the whole environment.
 *
 * @see Courier\Services\WorkspacePreferencesService::listLogs()
 *
 * @phpstan-type WorkspacePreferenceListLogsParamsShape = array{
 *   cursor?: string|null,
 *   limit?: int|null,
 *   since?: string|null,
 *   tenantID?: string|null,
 *   userID?: string|null,
 * }
 */
final class WorkspacePreferenceListLogsParams implements BaseModel
{
    /** @use SdkModel<WorkspacePreferenceListLogsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * A cursor from a previous response's paging.cursor. Continue only while paging.more is true; the cursor is omitted on the last page.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * How many entries to return. Defaults to 25.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Return only changes at or after this time, as an ISO-8601 date or date-time. A date alone is read as the start of that day in UTC.
     */
    #[Optional]
    public ?string $since;

    /**
     * Narrow to the changes this user made in one tenant context. Only valid together with user_id.
     */
    #[Optional]
    public ?string $tenantID;

    /**
     * Return only this user's changes. Omit it to read every change in the environment.
     */
    #[Optional]
    public ?string $userID;

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
        ?string $cursor = null,
        ?int $limit = null,
        ?string $since = null,
        ?string $tenantID = null,
        ?string $userID = null,
    ): self {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;
        null !== $since && $self['since'] = $since;
        null !== $tenantID && $self['tenantID'] = $tenantID;
        null !== $userID && $self['userID'] = $userID;

        return $self;
    }

    /**
     * A cursor from a previous response's paging.cursor. Continue only while paging.more is true; the cursor is omitted on the last page.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * How many entries to return. Defaults to 25.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Return only changes at or after this time, as an ISO-8601 date or date-time. A date alone is read as the start of that day in UTC.
     */
    public function withSince(string $since): self
    {
        $self = clone $this;
        $self['since'] = $since;

        return $self;
    }

    /**
     * Narrow to the changes this user made in one tenant context. Only valid together with user_id.
     */
    public function withTenantID(string $tenantID): self
    {
        $self = clone $this;
        $self['tenantID'] = $tenantID;

        return $self;
    }

    /**
     * Return only this user's changes. Omit it to read every change in the environment.
     */
    public function withUserID(string $userID): self
    {
        $self = clone $this;
        $self['userID'] = $userID;

        return $self;
    }
}
