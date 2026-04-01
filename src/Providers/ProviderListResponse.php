<?php

declare(strict_types=1);

namespace Courier\Providers;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Paging;

/**
 * Paginated list of provider configurations.
 *
 * @phpstan-import-type PagingShape from \Courier\Paging
 * @phpstan-import-type ProviderShape from \Courier\Providers\Provider
 *
 * @phpstan-type ProviderListResponseShape = array{
 *   paging: Paging|PagingShape, results: list<Provider|ProviderShape>
 * }
 */
final class ProviderListResponse implements BaseModel
{
    /** @use SdkModel<ProviderListResponseShape> */
    use SdkModel;

    #[Required]
    public Paging $paging;

    /** @var list<Provider> $results */
    #[Required(list: Provider::class)]
    public array $results;

    /**
     * `new ProviderListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProviderListResponse::with(paging: ..., results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProviderListResponse)->withPaging(...)->withResults(...)
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
     * @param list<Provider|ProviderShape> $results
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
     * @param list<Provider|ProviderShape> $results
     */
    public function withResults(array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }
}
