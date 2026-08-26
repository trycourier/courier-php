<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\NotificationMetricsResponse\Granularity;
use Courier\Notifications\NotificationMetricsResponse\Series;

/**
 * @phpstan-import-type SeriesShape from \Courier\Notifications\NotificationMetricsResponse\Series
 *
 * @phpstan-type NotificationMetricsResponseShape = array{
 *   end: \DateTimeInterface,
 *   granularity: Granularity|value-of<Granularity>,
 *   notificationID: string,
 *   series: list<Series|SeriesShape>,
 *   start: \DateTimeInterface,
 * }
 */
final class NotificationMetricsResponse implements BaseModel
{
    /** @use SdkModel<NotificationMetricsResponseShape> */
    use SdkModel;

    /**
     * End of the window actually queried, ceiled onto the granularity grid. Second-precision UTC.
     */
    #[Required]
    public \DateTimeInterface $end;

    /**
     * Bucket size the series was built at.
     *
     * @var value-of<Granularity> $granularity
     */
    #[Required(enum: Granularity::class)]
    public string $granularity;

    /**
     * The template the series describes, echoed from the request.
     */
    #[Required('notificationId')]
    public string $notificationID;

    /**
     * One entry per bucket between `start` and `end`, oldest first, including buckets with no activity.
     *
     * @var list<Series> $series
     */
    #[Required(list: Series::class)]
    public array $series;

    /**
     * Inclusive start of the window actually queried, floored onto the granularity grid. Second-precision UTC.
     */
    #[Required]
    public \DateTimeInterface $start;

    /**
     * `new NotificationMetricsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationMetricsResponse::with(
     *   end: ..., granularity: ..., notificationID: ..., series: ..., start: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationMetricsResponse)
     *   ->withEnd(...)
     *   ->withGranularity(...)
     *   ->withNotificationID(...)
     *   ->withSeries(...)
     *   ->withStart(...)
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
     *
     * @param Granularity|value-of<Granularity> $granularity
     * @param list<Series|SeriesShape> $series
     */
    public static function with(
        \DateTimeInterface $end,
        Granularity|string $granularity,
        string $notificationID,
        array $series,
        \DateTimeInterface $start,
    ): self {
        $self = new self;

        $self['end'] = $end;
        $self['granularity'] = $granularity;
        $self['notificationID'] = $notificationID;
        $self['series'] = $series;
        $self['start'] = $start;

        return $self;
    }

    /**
     * End of the window actually queried, ceiled onto the granularity grid. Second-precision UTC.
     */
    public function withEnd(\DateTimeInterface $end): self
    {
        $self = clone $this;
        $self['end'] = $end;

        return $self;
    }

    /**
     * Bucket size the series was built at.
     *
     * @param Granularity|value-of<Granularity> $granularity
     */
    public function withGranularity(Granularity|string $granularity): self
    {
        $self = clone $this;
        $self['granularity'] = $granularity;

        return $self;
    }

    /**
     * The template the series describes, echoed from the request.
     */
    public function withNotificationID(string $notificationID): self
    {
        $self = clone $this;
        $self['notificationID'] = $notificationID;

        return $self;
    }

    /**
     * One entry per bucket between `start` and `end`, oldest first, including buckets with no activity.
     *
     * @param list<Series|SeriesShape> $series
     */
    public function withSeries(array $series): self
    {
        $self = clone $this;
        $self['series'] = $series;

        return $self;
    }

    /**
     * Inclusive start of the window actually queried, floored onto the granularity grid. Second-precision UTC.
     */
    public function withStart(\DateTimeInterface $start): self
    {
        $self = clone $this;
        $self['start'] = $start;

        return $self;
    }
}
