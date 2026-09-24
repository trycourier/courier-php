<?php

declare(strict_types=1);

namespace Courier\WorkspacePreferences;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Paging;

/**
 * @phpstan-import-type PreferenceChangeLogEntryShape from \Courier\WorkspacePreferences\PreferenceChangeLogEntry
 * @phpstan-import-type PagingShape from \Courier\Paging
 *
 * @phpstan-type PreferenceLogsListResponseShape = array{
 *   items: list<PreferenceChangeLogEntry|PreferenceChangeLogEntryShape>,
 *   paging: Paging|PagingShape,
 * }
 */
final class PreferenceLogsListResponse implements BaseModel
{
    /** @use SdkModel<PreferenceLogsListResponseShape> */
    use SdkModel;

    /**
     * One entry per preference change, newest first.
     *
     * @var list<PreferenceChangeLogEntry> $items
     */
    #[Required(list: PreferenceChangeLogEntry::class)]
    public array $items;

    #[Required]
    public Paging $paging;

    /**
     * `new PreferenceLogsListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreferenceLogsListResponse::with(items: ..., paging: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreferenceLogsListResponse)->withItems(...)->withPaging(...)
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
     * @param list<PreferenceChangeLogEntry|PreferenceChangeLogEntryShape> $items
     * @param Paging|PagingShape $paging
     */
    public static function with(array $items, Paging|array $paging): self
    {
        $self = new self;

        $self['items'] = $items;
        $self['paging'] = $paging;

        return $self;
    }

    /**
     * One entry per preference change, newest first.
     *
     * @param list<PreferenceChangeLogEntry|PreferenceChangeLogEntryShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }

    /**
     * @param Paging|PagingShape $paging
     */
    public function withPaging(Paging|array $paging): self
    {
        $self = clone $this;
        $self['paging'] = $paging;

        return $self;
    }
}
