<?php

declare(strict_types=1);

namespace Courier\Digests\Schedules;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * List the digest instances for a schedule. Each instance represents the events accumulated for a single user against the schedule, and can be used to monitor digest accumulation before the digest is released.
 *
 * @see Courier\Services\Digests\SchedulesService::listInstances()
 *
 * @phpstan-type ScheduleListInstancesParamsShape = array{
 *   cursor?: string|null, limit?: int|null
 * }
 */
final class ScheduleListInstancesParams implements BaseModel
{
    /** @use SdkModel<ScheduleListInstancesParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * A cursor token from a previous response, used to fetch the next page of results.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * The maximum number of digest instances to return. Defaults to 20, with a maximum of 100.
     */
    #[Optional]
    public ?int $limit;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $cursor = null, ?int $limit = null): self
    {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;

        return $self;
    }

    /**
     * A cursor token from a previous response, used to fetch the next page of results.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * The maximum number of digest instances to return. Defaults to 20, with a maximum of 100.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }
}
