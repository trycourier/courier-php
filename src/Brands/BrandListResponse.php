<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Audiences\Paging;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type brand_list_response = array{paging: Paging, results: list<Brand>}
 * When used in a response, this type parameter can define a $rawResponse property.
 * @template TRawResponse of object = object{}
 *
 * @mixin TRawResponse
 */
final class BrandListResponse implements BaseModel
{
    /** @use SdkModel<brand_list_response> */
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
     * @param list<Brand> $results
     */
    public static function with(Paging $paging, array $results): self
    {
        $obj = new self;

        $obj->paging = $paging;
        $obj->results = $results;

        return $obj;
    }

    public function withPaging(Paging $paging): self
    {
        $obj = clone $this;
        $obj->paging = $paging;

        return $obj;
    }

    /**
     * @param list<Brand> $results
     */
    public function withResults(array $results): self
    {
        $obj = clone $this;
        $obj->results = $results;

        return $obj;
    }
}
