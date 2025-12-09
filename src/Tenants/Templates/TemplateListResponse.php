<?php

declare(strict_types=1);

namespace Courier\Tenants\Templates;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Tenants\Templates\TemplateListResponse\Item;
use Courier\Tenants\Templates\TemplateListResponse\Type;

/**
 * @phpstan-type TemplateListResponseShape = array{
 *   hasMore: bool,
 *   type: value-of<Type>,
 *   url: string,
 *   cursor?: string|null,
 *   items?: list<mixed>|null,
 *   nextURL?: string|null,
 * }
 */
final class TemplateListResponse implements BaseModel
{
    /** @use SdkModel<TemplateListResponseShape> */
    use SdkModel;

    /**
     * Set to true when there are more pages that can be retrieved.
     */
    #[Required('has_more')]
    public bool $hasMore;

    /**
     * Always set to `list`. Represents the type of this object.
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
     * A pointer to the next page of results. Defined
     * only when `has_more` is set to true.
     */
    #[Optional(nullable: true)]
    public ?string $cursor;

    /** @var list<mixed>|null $items */
    #[Optional(list: Item::class, nullable: true)]
    public ?array $items;

    /**
     * A url that may be used to generate fetch the next set of results.
     * Defined only when `has_more` is set to true.
     */
    #[Optional('next_url', nullable: true)]
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
     * @param list<mixed>|null $items
     */
    public static function with(
        bool $hasMore,
        Type|string $type,
        string $url,
        ?string $cursor = null,
        ?array $items = null,
        ?string $nextURL = null,
    ): self {
        $self = new self;

        $self['hasMore'] = $hasMore;
        $self['type'] = $type;
        $self['url'] = $url;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $items && $self['items'] = $items;
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
     * Always set to `list`. Represents the type of this object.
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
     * A pointer to the next page of results. Defined
     * only when `has_more` is set to true.
     */
    public function withCursor(?string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * @param list<mixed>|null $items
     */
    public function withItems(?array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }

    /**
     * A url that may be used to generate fetch the next set of results.
     * Defined only when `has_more` is set to true.
     */
    public function withNextURL(?string $nextURL): self
    {
        $self = clone $this;
        $self['nextURL'] = $nextURL;

        return $self;
    }
}
