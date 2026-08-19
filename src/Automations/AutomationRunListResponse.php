<?php

declare(strict_types=1);

namespace Courier\Automations;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * A page of Automation runs.
 *
 * @phpstan-import-type AutomationRunListItemShape from \Courier\Automations\AutomationRunListItem
 *
 * @phpstan-type AutomationRunListResponseShape = array{
 *   runs: list<AutomationRunListItem|AutomationRunListItemShape>,
 *   nextCursor?: string|null,
 * }
 */
final class AutomationRunListResponse implements BaseModel
{
    /** @use SdkModel<AutomationRunListResponseShape> */
    use SdkModel;

    /** @var list<AutomationRunListItem> $runs */
    #[Required(list: AutomationRunListItem::class)]
    public array $runs;

    /**
     * Pass back as `cursor` to fetch the next page. Absent on the last page.
     */
    #[Optional('next_cursor')]
    public ?string $nextCursor;

    /**
     * `new AutomationRunListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AutomationRunListResponse::with(runs: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AutomationRunListResponse)->withRuns(...)
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
     * @param list<AutomationRunListItem|AutomationRunListItemShape> $runs
     */
    public static function with(array $runs, ?string $nextCursor = null): self
    {
        $self = new self;

        $self['runs'] = $runs;

        null !== $nextCursor && $self['nextCursor'] = $nextCursor;

        return $self;
    }

    /**
     * @param list<AutomationRunListItem|AutomationRunListItemShape> $runs
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
}
