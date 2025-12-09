<?php

declare(strict_types=1);

namespace Courier\Audiences;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Paging;

/**
 * @phpstan-type AudienceListResponseShape = array{
 *   items: list<Audience>, paging: Paging
 * }
 */
final class AudienceListResponse implements BaseModel
{
    /** @use SdkModel<AudienceListResponseShape> */
    use SdkModel;

    /** @var list<Audience> $items */
    #[Required(list: Audience::class)]
    public array $items;

    #[Required]
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
     * @param list<Audience|array{
     *   id: string,
     *   created_at: string,
     *   description: string,
     *   filter: Filter,
     *   name: string,
     *   updated_at: string,
     * }> $items
     * @param Paging|array{more: bool, cursor?: string|null} $paging
     */
    public static function with(array $items, Paging|array $paging): self
    {
        $obj = new self;

        $obj['items'] = $items;
        $obj['paging'] = $paging;

        return $obj;
    }

    /**
     * @param list<Audience|array{
     *   id: string,
     *   created_at: string,
     *   description: string,
     *   filter: Filter,
     *   name: string,
     *   updated_at: string,
     * }> $items
     */
    public function withItems(array $items): self
    {
        $obj = clone $this;
        $obj['items'] = $items;

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
}
