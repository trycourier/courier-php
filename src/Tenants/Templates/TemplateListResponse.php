<?php

declare(strict_types=1);

namespace Courier\Tenants\Templates;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkResponse;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\Contracts\ResponseConverter;
use Courier\Tenants\Templates\TemplateListResponse\Item;
use Courier\Tenants\Templates\TemplateListResponse\Type;

/**
 * @phpstan-type TemplateListResponseShape = array{
 *   hasMore: bool,
 *   type: value-of<Type>,
 *   url: string,
 *   cursor?: string|null,
 *   items?: list<Item>|null,
 *   nextURL?: string|null,
 * }
 */
final class TemplateListResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<TemplateListResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * Set to true when there are more pages that can be retrieved.
     */
    #[Api('has_more')]
    public bool $hasMore;

    /**
     * Always set to `list`. Represents the type of this object.
     *
     * @var value-of<Type> $type
     */
    #[Api(enum: Type::class)]
    public string $type;

    /**
     * A url that may be used to generate these results.
     */
    #[Api]
    public string $url;

    /**
     * A pointer to the next page of results. Defined
     * only when `has_more` is set to true.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $cursor;

    /** @var list<Item>|null $items */
    #[Api(list: Item::class, nullable: true, optional: true)]
    public ?array $items;

    /**
     * A url that may be used to generate fetch the next set of results.
     * Defined only when `has_more` is set to true.
     */
    #[Api('next_url', nullable: true, optional: true)]
    public ?string $nextURL;

    /**
     * `new TemplateListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TemplateListResponse::with(hasMore: ..., type: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TemplateListResponse)->withHasMore(...)->withType(...)->withURL(...)
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
     * @param Type|value-of<Type> $type
     * @param list<Item>|null $items
     */
    public static function with(
        bool $hasMore,
        Type|string $type,
        string $url,
        ?string $cursor = null,
        ?array $items = null,
        ?string $nextURL = null,
    ): self {
        $obj = new self;

        $obj->hasMore = $hasMore;
        $obj['type'] = $type;
        $obj->url = $url;

        null !== $cursor && $obj->cursor = $cursor;
        null !== $items && $obj->items = $items;
        null !== $nextURL && $obj->nextURL = $nextURL;

        return $obj;
    }

    /**
     * Set to true when there are more pages that can be retrieved.
     */
    public function withHasMore(bool $hasMore): self
    {
        $obj = clone $this;
        $obj->hasMore = $hasMore;

        return $obj;
    }

    /**
     * Always set to `list`. Represents the type of this object.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $obj = clone $this;
        $obj['type'] = $type;

        return $obj;
    }

    /**
     * A url that may be used to generate these results.
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }

    /**
     * A pointer to the next page of results. Defined
     * only when `has_more` is set to true.
     */
    public function withCursor(?string $cursor): self
    {
        $obj = clone $this;
        $obj->cursor = $cursor;

        return $obj;
    }

    /**
     * @param list<Item>|null $items
     */
    public function withItems(?array $items): self
    {
        $obj = clone $this;
        $obj->items = $items;

        return $obj;
    }

    /**
     * A url that may be used to generate fetch the next set of results.
     * Defined only when `has_more` is set to true.
     */
    public function withNextURL(?string $nextURL): self
    {
        $obj = clone $this;
        $obj->nextURL = $nextURL;

        return $obj;
    }
}
