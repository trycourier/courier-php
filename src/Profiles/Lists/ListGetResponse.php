<?php

declare(strict_types=1);

namespace Courier\Profiles\Lists;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkResponse;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\Contracts\ResponseConverter;
use Courier\Paging;
use Courier\Profiles\Lists\ListGetResponse\Result;

/**
 * @phpstan-type list_get_response = array{paging: Paging, results: list<Result>}
 */
final class ListGetResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<list_get_response> */
    use SdkModel;

    use SdkResponse;

    #[Api]
    public Paging $paging;

    /**
     * An array of lists.
     *
     * @var list<Result> $results
     */
    #[Api(list: Result::class)]
    public array $results;

    /**
     * `new ListGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ListGetResponse::with(paging: ..., results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ListGetResponse)->withPaging(...)->withResults(...)
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
     * @param list<Result> $results
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
     * An array of lists.
     *
     * @param list<Result> $results
     */
    public function withResults(array $results): self
    {
        $obj = clone $this;
        $obj->results = $results;

        return $obj;
    }
}
