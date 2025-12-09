<?php

declare(strict_types=1);

namespace Courier\Profiles\Lists;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Paging;
use Courier\Profiles\Lists\ListGetResponse\Result;
use Courier\RecipientPreferences;

/**
 * @phpstan-type ListGetResponseShape = array{
 *   paging: Paging, results: list<Result>
 * }
 */
final class ListGetResponse implements BaseModel
{
    /** @use SdkModel<ListGetResponseShape> */
    use SdkModel;

    #[Required]
    public Paging $paging;

    /**
     * An array of lists.
     *
     * @var list<Result> $results
     */
    #[Required(list: Result::class)]
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
     * @param Paging|array{more: bool, cursor?: string|null} $paging
     * @param list<Result|array{
     *   id: string,
     *   created: string,
     *   name: string,
     *   updated: string,
     *   preferences?: RecipientPreferences|null,
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
     * An array of lists.
     *
     * @param list<Result|array{
     *   id: string,
     *   created: string,
     *   name: string,
     *   updated: string,
     *   preferences?: RecipientPreferences|null,
     * }> $results
     */
    public function withResults(array $results): self
    {
        $obj = clone $this;
        $obj['results'] = $results;

        return $obj;
    }
}
