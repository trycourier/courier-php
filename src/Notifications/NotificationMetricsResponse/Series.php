<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationMetricsResponse;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\NotificationMetricsResponse\Series\Data;

/**
 * @phpstan-import-type DataShape from \Courier\Notifications\NotificationMetricsResponse\Series\Data
 *
 * @phpstan-type SeriesShape = array{
 *   data: list<Data|DataShape>, period: \DateTimeInterface
 * }
 */
final class Series implements BaseModel
{
    /** @use SdkModel<SeriesShape> */
    use SdkModel;

    /**
     * One entry per provider and channel that handled a message in this bucket. Empty when nothing was sent.
     *
     * @var list<Data> $data
     */
    #[Required(list: Data::class)]
    public array $data;

    /**
     * Start of the bucket, second-precision UTC.
     */
    #[Required]
    public \DateTimeInterface $period;

    /**
     * `new Series()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Series::with(data: ..., period: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Series)->withData(...)->withPeriod(...)
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
     * @param list<Data|DataShape> $data
     */
    public static function with(array $data, \DateTimeInterface $period): self
    {
        $self = new self;

        $self['data'] = $data;
        $self['period'] = $period;

        return $self;
    }

    /**
     * One entry per provider and channel that handled a message in this bucket. Empty when nothing was sent.
     *
     * @param list<Data|DataShape> $data
     */
    public function withData(array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * Start of the bucket, second-precision UTC.
     */
    public function withPeriod(\DateTimeInterface $period): self
    {
        $self = clone $this;
        $self['period'] = $period;

        return $self;
    }
}
