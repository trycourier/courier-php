<?php

declare(strict_types=1);

namespace Courier\Providers\Catalog;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Paging;
use Courier\Providers\ProvidersCatalogEntry;

/**
 * Paginated list of available provider types with their configuration schemas.
 *
 * @phpstan-import-type PagingShape from \Courier\Paging
 * @phpstan-import-type ProvidersCatalogEntryShape from \Courier\Providers\ProvidersCatalogEntry
 *
 * @phpstan-type CatalogListResponseShape = array{
 *   paging: Paging|PagingShape,
 *   results: list<ProvidersCatalogEntry|ProvidersCatalogEntryShape>,
 * }
 */
final class CatalogListResponse implements BaseModel
{
    /** @use SdkModel<CatalogListResponseShape> */
    use SdkModel;

    #[Required]
    public Paging $paging;

    /** @var list<ProvidersCatalogEntry> $results */
    #[Required(list: ProvidersCatalogEntry::class)]
    public array $results;

    /**
     * `new CatalogListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CatalogListResponse::with(paging: ..., results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CatalogListResponse)->withPaging(...)->withResults(...)
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
     * @param Paging|PagingShape $paging
     * @param list<ProvidersCatalogEntry|ProvidersCatalogEntryShape> $results
     */
    public static function with(Paging|array $paging, array $results): self
    {
        $self = new self;

        $self['paging'] = $paging;
        $self['results'] = $results;

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

    /**
     * @param list<ProvidersCatalogEntry|ProvidersCatalogEntryShape> $results
     */
    public function withResults(array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }
}
