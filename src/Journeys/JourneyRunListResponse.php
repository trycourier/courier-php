<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * A page of Journey runs.
 *
 * @phpstan-import-type JourneyRunListItemShape from \Courier\Journeys\JourneyRunListItem
 *
 * @phpstan-type JourneyRunListResponseShape = array{
 *   runs: list<JourneyRunListItem|JourneyRunListItemShape>,
 *   nextCursor?: string|null,
 *   prevCursor?: string|null,
 * }
 */
final class JourneyRunListResponse implements BaseModel
{
    /** @use SdkModel<JourneyRunListResponseShape> */
    use SdkModel;

    /** @var list<JourneyRunListItem> $runs */
    #[Required(list: JourneyRunListItem::class)]
    public array $runs;

    /**
     * Pass back as `cursor` to fetch the next page. Absent on the last page.
     */
    #[Optional('next_cursor')]
    public ?string $nextCursor;

    /**
     * Pass back as `cursor` to fetch the previous page. Absent on the first page.
     */
    #[Optional('prev_cursor')]
    public ?string $prevCursor;

    /**
     * `new JourneyRunListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneyRunListResponse::with(runs: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneyRunListResponse)->withRuns(...)
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
     * @param list<JourneyRunListItem|JourneyRunListItemShape> $runs
     */
    public static function with(
        array $runs,
        ?string $nextCursor = null,
        ?string $prevCursor = null
    ): self {
        $self = new self;

        $self['runs'] = $runs;

        null !== $nextCursor && $self['nextCursor'] = $nextCursor;
        null !== $prevCursor && $self['prevCursor'] = $prevCursor;

        return $self;
    }

    /**
     * @param list<JourneyRunListItem|JourneyRunListItemShape> $runs
     */
    public function withRuns(array $runs): self
    {
        $self = clone $this;
        $self['runs'] = $runs;

        return $self;
    }

    /**
     * Pass back as `cursor` to fetch the next page. Absent on the last page.
     */
    public function withNextCursor(string $nextCursor): self
    {
        $self = clone $this;
        $self['nextCursor'] = $nextCursor;

        return $self;
    }

    /**
     * Pass back as `cursor` to fetch the previous page. Absent on the first page.
     */
    public function withPrevCursor(string $prevCursor): self
    {
        $self = clone $this;
        $self['prevCursor'] = $prevCursor;

        return $self;
    }
}
