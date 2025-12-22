<?php

declare(strict_types=1);

namespace Courier\Tenants;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Tenants\TenantListResponse\Type;

/**
 * @phpstan-import-type TenantShape from \Courier\Tenants\Tenant
 *
 * @phpstan-type TenantListResponseShape = array{
 *   hasMore: bool,
 *   items: list<TenantShape>,
 *   type: Type|value-of<Type>,
 *   url: string,
 *   cursor?: string|null,
 *   nextURL?: string|null,
 * }
 */
final class TenantListResponse implements BaseModel
{
    /** @use SdkModel<TenantListResponseShape> */
    use SdkModel;

    /**
     * Set to true when there are more pages that can be retrieved.
     */
    #[Required('has_more')]
    public bool $hasMore;

    /**
     * An array of Tenants.
     *
     * @var list<Tenant> $items
     */
    #[Required(list: Tenant::class)]
    public array $items;

    /**
     * Always set to "list". Represents the type of this object.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * A url that may be used to generate these results.
     */
    #[Required]
    public string $url;

    /**
     * A pointer to the next page of results. Defined only when has_more is set to true.
     */
    #[Optional(nullable: true)]
    public ?string $cursor;

    /**
     * A url that may be used to generate fetch the next set of results.
     * Defined only when has_more is set to true.
     */
    #[Optional('next_url', nullable: true)]
    public ?string $nextURL;

    /**
     * `new TenantListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TenantListResponse::with(hasMore: ..., items: ..., type: ..., url: ...)
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
     * @param list<TenantShape> $items
     * @param Type|value-of<Type> $type
     */
    public static function with(
        bool $hasMore,
        array $items,
        Type|string $type,
        string $url,
        ?string $cursor = null,
        ?string $nextURL = null,
    ): self {
        $self = new self;

        $self['hasMore'] = $hasMore;
        $self['items'] = $items;
        $self['type'] = $type;
        $self['url'] = $url;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $nextURL && $self['nextURL'] = $nextURL;

        return $self;
    }

    /**
     * Set to true when there are more pages that can be retrieved.
     */
    public function withHasMore(bool $hasMore): self
    {
        $self = clone $this;
        $self['hasMore'] = $hasMore;

        return $self;
    }

    /**
     * An array of Tenants.
     *
     * @param list<TenantShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }

    /**
     * Always set to "list". Represents the type of this object.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * A url that may be used to generate these results.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * A pointer to the next page of results. Defined only when has_more is set to true.
     */
    public function withCursor(?string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * A url that may be used to generate fetch the next set of results.
     * Defined only when has_more is set to true.
     */
    public function withNextURL(?string $nextURL): self
    {
        $self = clone $this;
        $self['nextURL'] = $nextURL;

        return $self;
    }
}
