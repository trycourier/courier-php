<?php

declare(strict_types=1);

namespace Courier\Audiences;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Paging;

/**
 * @phpstan-import-type AudienceShape from \Courier\Audiences\Audience
 * @phpstan-import-type PagingShape from \Courier\Paging
 *
 * @phpstan-type AudienceListResponseShape = array{
 *   items: list<AudienceShape>, paging: Paging|PagingShape
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
     * @param list<AudienceShape> $items
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
     * @param list<AudienceShape> $items
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
