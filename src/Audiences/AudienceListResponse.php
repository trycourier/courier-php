<?php

declare(strict_types=1);

namespace Courier\Audiences;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkResponse;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\Contracts\ResponseConverter;
use Courier\Paging;

/**
 * @phpstan-type audience_list_response = array{
 *   items: list<Audience>, paging: Paging
 * }
 */
final class AudienceListResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<audience_list_response> */
    use SdkModel;

    use SdkResponse;

    /** @var list<Audience> $items */
    #[Api(list: Audience::class)]
    public array $items;

    #[Api]
    public Paging $paging;

    /**
     * `new AudienceListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AudienceListResponse::with(items: ..., paging: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AudienceListResponse)->withItems(...)->withPaging(...)
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
     * @param list<Audience> $items
     */
    public static function with(array $items, Paging $paging): self
    {
        $obj = new self;

        $obj->items = $items;
        $obj->paging = $paging;

        return $obj;
    }

    /**
     * @param list<Audience> $items
     */
    public function withItems(array $items): self
    {
        $obj = clone $this;
        $obj->items = $items;

        return $obj;
    }

    public function withPaging(Paging $paging): self
    {
        $obj = clone $this;
        $obj->paging = $paging;

        return $obj;
    }
}
