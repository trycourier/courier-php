<?php

declare(strict_types=1);

namespace Courier\Automations\Runs;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * List runs of the workspace's v2 Automations, newest first, filtered by status, Template, or date range and paged by cursor. Journey (v3) runs are listed by `GET /journeys/runs` instead — the two surfaces never return each other's runs. Runs are retained for 95 days.
 *
 * @see Courier\Services\Automations\RunsService::list()
 *
 * @phpstan-type RunListParamsShape = array{
 *   cursor?: string|null,
 *   endDate?: string|null,
 *   limit?: string|null,
 *   startDate?: string|null,
 *   status?: string|null,
 *   templateID?: string|null,
 * }
 */
final class RunListParams implements BaseModel
{
    /** @use SdkModel<RunListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * A cursor token for pagination. Use the `next_cursor` from the previous response to fetch the next page of results. Treat it as opaque.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * An inclusive upper bound on `created_at`, in the same format as `start_date`.
     */
    #[Optional]
    public ?string $endDate;

    /**
     * The number of runs to return per page, between `1` and `50`. Defaults to `20`. Values outside the range are clamped, and a non-numeric value falls back to `20`.
     */
    #[Optional]
    public ?string $limit;

    /**
     * An inclusive lower bound on `created_at`, as an ISO 8601 date or timestamp (e.g. `2026-08-18` or `2026-08-18T20:06:36.259Z`). Any other format returns `400`.
     */
    #[Optional]
    public ?string $startDate;

    /**
     * A comma-separated list of run statuses to filter on, e.g. `PROCESSED,ERROR`.
     */
    #[Optional]
    public ?string $status;

    /**
     * A comma-separated list of Automation Template ids to filter on.
     */
    #[Optional]
    public ?string $templateID;

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
        ?string $endDate = null,
        ?string $limit = null,
        ?string $startDate = null,
        ?string $status = null,
        ?string $templateID = null,
    ): self {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $endDate && $self['endDate'] = $endDate;
        null !== $limit && $self['limit'] = $limit;
        null !== $startDate && $self['startDate'] = $startDate;
        null !== $status && $self['status'] = $status;
        null !== $templateID && $self['templateID'] = $templateID;

        return $self;
    }

    /**
     * A cursor token for pagination. Use the `next_cursor` from the previous response to fetch the next page of results. Treat it as opaque.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * An inclusive upper bound on `created_at`, in the same format as `start_date`.
     */
    public function withEndDate(string $endDate): self
    {
        $self = clone $this;
        $self['endDate'] = $endDate;

        return $self;
    }

    /**
     * The number of runs to return per page, between `1` and `50`. Defaults to `20`. Values outside the range are clamped, and a non-numeric value falls back to `20`.
     */
    public function withLimit(string $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * An inclusive lower bound on `created_at`, as an ISO 8601 date or timestamp (e.g. `2026-08-18` or `2026-08-18T20:06:36.259Z`). Any other format returns `400`.
     */
    public function withStartDate(string $startDate): self
    {
        $self = clone $this;
        $self['startDate'] = $startDate;

        return $self;
    }

    /**
     * A comma-separated list of run statuses to filter on, e.g. `PROCESSED,ERROR`.
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * A comma-separated list of Automation Template ids to filter on.
     */
    public function withTemplateID(string $templateID): self
    {
        $self = clone $this;
        $self['templateID'] = $templateID;

        return $self;
    }
}
