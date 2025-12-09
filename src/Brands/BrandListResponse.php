<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Paging;

/**
 * @phpstan-type BrandListResponseShape = array{
 *   paging: Paging, results: list<Brand>
 * }
 */
final class BrandListResponse implements BaseModel
{
    /** @use SdkModel<BrandListResponseShape> */
    use SdkModel;

    #[Api]
    public Paging $paging;

    /** @var list<Brand> $results */
    #[Api(list: Brand::class)]
    public array $results;

    /**
     * `new BrandListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BrandListResponse::with(paging: ..., results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BrandListResponse)->withPaging(...)->withResults(...)
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
     * @param Paging|array{more: bool, cursor?: string|null} $paging
     * @param list<Brand|array{
     *   id: string,
     *   created: int,
     *   name: string,
     *   updated: int,
     *   published?: int|null,
     *   settings?: BrandSettings|null,
     *   snippets?: BrandSnippets|null,
     *   version?: string|null,
     * }> $results
     */
    public static function with(Paging|array $paging, array $results): self
    {
        $obj = new self;

        $obj['paging'] = $paging;
        $obj['results'] = $results;

        return $obj;
    }

    /**
     * @param Paging|array{more: bool, cursor?: string|null} $paging
     */
    public function withPaging(Paging|array $paging): self
    {
        $obj = clone $this;
        $obj['paging'] = $paging;

        return $obj;
    }

    /**
     * @param list<Brand|array{
     *   id: string,
     *   created: int,
     *   name: string,
     *   updated: int,
     *   published?: int|null,
     *   settings?: BrandSettings|null,
     *   snippets?: BrandSnippets|null,
     *   version?: string|null,
     * }> $results
     */
    public function withResults(array $results): self
    {
        $obj = clone $this;
        $obj['results'] = $results;

        return $obj;
    }
}
