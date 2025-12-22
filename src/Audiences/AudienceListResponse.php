<?php

declare(strict_types=1);

namespace Courier\Audiences;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Paging;

/**
 * @phpstan-import-type PagingShape from \Courier\Paging
 *
 * @phpstan-type AudienceListResponseShape = array{
 *   items: list<mixed>, paging: Paging|PagingShape
 * }
 */
final class AudienceListResponse implements BaseModel
{
    /** @use SdkModel<AudienceListResponseShape> */
    use SdkModel;

    /** @var list<mixed> $items */
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
     * @param list<mixed> $items
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
     * @param list<mixed> $items
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
