<?php

declare(strict_types=1);

namespace Courier\Tenants;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkResponse;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\Contracts\ResponseConverter;
use Courier\Tenants\TenantListResponse\Type;

/**
 * @phpstan-type TenantListResponseShape = array{
 *   has_more: bool,
 *   items: list<Tenant>,
 *   type: value-of<Type>,
 *   url: string,
 *   cursor?: string|null,
 *   next_url?: string|null,
 * }
 */
final class TenantListResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<TenantListResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * Set to true when there are more pages that can be retrieved.
     */
    #[Api]
    public bool $has_more;

    /**
     * An array of Tenants.
     *
     * @var list<Tenant> $items
     */
    #[Api(list: Tenant::class)]
    public array $items;

    /**
     * Always set to "list". Represents the type of this object.
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
     * A pointer to the next page of results. Defined only when has_more is set to true.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $cursor;

    /**
     * A url that may be used to generate fetch the next set of results.
     * Defined only when has_more is set to true.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $next_url;

    /**
     * `new TenantListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TenantListResponse::with(has_more: ..., items: ..., type: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TenantListResponse)
     *   ->withHasMore(...)
     *   ->withItems(...)
     *   ->withType(...)
     *   ->withURL(...)
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
     * @param list<Tenant> $items
     * @param Type|value-of<Type> $type
     */
    public static function with(
        bool $has_more,
        array $items,
        Type|string $type,
        string $url,
        ?string $cursor = null,
        ?string $next_url = null,
    ): self {
        $obj = new self;

        $obj->has_more = $has_more;
        $obj->items = $items;
        $obj['type'] = $type;
        $obj->url = $url;

        null !== $cursor && $obj->cursor = $cursor;
        null !== $next_url && $obj->next_url = $next_url;

        return $obj;
    }

    /**
     * Set to true when there are more pages that can be retrieved.
     */
    public function withHasMore(bool $hasMore): self
    {
        $obj = clone $this;
        $obj->has_more = $hasMore;

        return $obj;
    }

    /**
     * An array of Tenants.
     *
     * @param list<Tenant> $items
     */
    public function withItems(array $items): self
    {
        $obj = clone $this;
        $obj->items = $items;

        return $obj;
    }

    /**
     * Always set to "list". Represents the type of this object.
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
     * A pointer to the next page of results. Defined only when has_more is set to true.
     */
    public function withCursor(?string $cursor): self
    {
        $obj = clone $this;
        $obj->cursor = $cursor;

        return $obj;
    }

    /**
     * A url that may be used to generate fetch the next set of results.
     * Defined only when has_more is set to true.
     */
    public function withNextURL(?string $nextURL): self
    {
        $obj = clone $this;
        $obj->next_url = $nextURL;

        return $obj;
    }
}
