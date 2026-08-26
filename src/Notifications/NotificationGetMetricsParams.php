<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\NotificationGetMetricsParams\Granularity;

/**
 * Fetch the delivery funnel for one Notification Template as a time series — sent, delivered, opened, clicked, errors, and undeliverable — broken out per provider and channel inside each bucket. Sum the entries in a bucket for its totals; there is no bucket-level total.
 *
 * Choose the window absolutely with `start` and `end`, or relatively with `lookback` (an ISO 8601 duration). `start` and `end` take precedence when both are supplied, and a request carrying neither defaults to `lookback=P30D`. The window is snapped outwards onto the `granularity` grid so every bucket it overlaps is returned whole, and the snapped boundaries come back as `start` and `end` — align a chart on those rather than on what was requested. Every boundary is UTC; there is no timezone support.
 *
 * Every bucket in the window is returned, including the quiet ones, whose `data` array is empty, so a series is directly plottable with no gap filling client-side. An unknown template id returns `200` with an all-empty series rather than `404`, and messages sent without a Notification Template never appear here.
 *
 * Available in the US region only.
 *
 * @see Courier\Services\NotificationsService::getMetrics()
 *
 * @phpstan-type NotificationGetMetricsParamsShape = array{
 *   end?: \DateTimeInterface|null,
 *   granularity?: null|Granularity|value-of<Granularity>,
 *   lookback?: string|null,
 *   start?: \DateTimeInterface|null,
 * }
 */
final class NotificationGetMetricsParams implements BaseModel
{
    /** @use SdkModel<NotificationGetMetricsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The end of the window, as an ISO 8601 timestamp with an offset. Must be supplied together with `start`. An `end` in the future is accepted and not clamped — the trailing buckets come back empty.
     */
    #[Optional]
    public ?\DateTimeInterface $end;

    /**
     * The size of each bucket in the series. Defaults to `DAY`. `WEEK` buckets start on Sunday. A fine granularity caps the window it can cover: `HOUR` spans at most 7 days and `DAY` at most 90 days, and a wider window returns `400` — request a coarser granularity instead. `WEEK` and `MONTH` are uncapped, subject to the 1000-bucket limit on a single response.
     *
     * @var value-of<Granularity>|null $granularity
     */
    #[Optional(enum: Granularity::class)]
    public ?string $granularity;

    /**
     * The length of the window, counted back from now, as an ISO 8601 duration (`P30D`, `P12W`, `PT12H`). Defaults to `P30D`, and is ignored when `start` and `end` are supplied. A malformed or non-positive duration returns `400`.
     */
    #[Optional]
    public ?string $lookback;

    /**
     * The inclusive start of the window, as an ISO 8601 timestamp with an offset (`2026-04-01T00:00:00Z`). Must be supplied together with `end` and be earlier than it; either one alone returns `400`.
     */
    #[Optional]
    public ?\DateTimeInterface $start;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Granularity|value-of<Granularity>|null $granularity
     */
    public static function with(
        ?\DateTimeInterface $end = null,
        Granularity|string|null $granularity = null,
        ?string $lookback = null,
        ?\DateTimeInterface $start = null,
    ): self {
        $self = new self;

        null !== $end && $self['end'] = $end;
        null !== $granularity && $self['granularity'] = $granularity;
        null !== $lookback && $self['lookback'] = $lookback;
        null !== $start && $self['start'] = $start;

        return $self;
    }

    /**
     * The end of the window, as an ISO 8601 timestamp with an offset. Must be supplied together with `start`. An `end` in the future is accepted and not clamped — the trailing buckets come back empty.
     */
    public function withEnd(\DateTimeInterface $end): self
    {
        $self = clone $this;
        $self['end'] = $end;

        return $self;
    }

    /**
     * The size of each bucket in the series. Defaults to `DAY`. `WEEK` buckets start on Sunday. A fine granularity caps the window it can cover: `HOUR` spans at most 7 days and `DAY` at most 90 days, and a wider window returns `400` — request a coarser granularity instead. `WEEK` and `MONTH` are uncapped, subject to the 1000-bucket limit on a single response.
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
     * The length of the window, counted back from now, as an ISO 8601 duration (`P30D`, `P12W`, `PT12H`). Defaults to `P30D`, and is ignored when `start` and `end` are supplied. A malformed or non-positive duration returns `400`.
     */
    public function withLookback(string $lookback): self
    {
        $self = clone $this;
        $self['lookback'] = $lookback;

        return $self;
    }

    /**
     * The inclusive start of the window, as an ISO 8601 timestamp with an offset (`2026-04-01T00:00:00Z`). Must be supplied together with `end` and be earlier than it; either one alone returns `400`.
     */
    public function withStart(\DateTimeInterface $start): self
    {
        $self = clone $this;
        $self['start'] = $start;

        return $self;
    }
}
