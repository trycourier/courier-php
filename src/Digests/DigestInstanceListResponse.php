<?php

declare(strict_types=1);

namespace Courier\Digests;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Digests\DigestInstanceListResponse\Type;

/**
 * @phpstan-import-type DigestInstanceShape from \Courier\Digests\DigestInstance
 *
 * @phpstan-type DigestInstanceListResponseShape = array{
 *   hasMore: bool,
 *   items: list<DigestInstance|DigestInstanceShape>,
 *   type: Type|value-of<Type>,
 *   cursor?: string|null,
 *   nextURL?: string|null,
 *   url?: string|null,
 * }
 */
final class DigestInstanceListResponse implements BaseModel
{
    /** @use SdkModel<DigestInstanceListResponseShape> */
    use SdkModel;

    /**
     * Whether there are more digest instances to fetch using the cursor.
     */
    #[Required('has_more')]
    public bool $hasMore;

    /**
     * The digest instances for this page of results.
     *
     * @var list<DigestInstance> $items
     */
    #[Required(list: DigestInstance::class)]
    public array $items;

    /**
     * Always `list` for a paginated list response.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * A cursor token for fetching the next page of results, or null when there are none.
     */
    #[Optional(nullable: true)]
    public ?string $cursor;

    /**
     * The path to fetch the next page of results, or null when there are none.
     */
    #[Optional('next_url', nullable: true)]
    public ?string $nextURL;

    /**
     * The path of the current request.
     */
    #[Optional]
    public ?string $url;

    /**
     * `new DigestInstanceListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DigestInstanceListResponse::with(hasMore: ..., items: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DigestInstanceListResponse)
     *   ->withHasMore(...)
     *   ->withItems(...)
     *   ->withType(...)
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
     * @param list<DigestInstance|DigestInstanceShape> $items
     * @param Type|value-of<Type> $type
     */
    public static function with(
        bool $hasMore,
        array $items,
        Type|string $type,
        ?string $cursor = null,
        ?string $nextURL = null,
        ?string $url = null,
    ): self {
        $self = new self;

        $self['hasMore'] = $hasMore;
        $self['items'] = $items;
        $self['type'] = $type;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $nextURL && $self['nextURL'] = $nextURL;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    /**
     * Whether there are more digest instances to fetch using the cursor.
     */
    public function withHasMore(bool $hasMore): self
    {
        $self = clone $this;
        $self['hasMore'] = $hasMore;

        return $self;
    }

    /**
     * The digest instances for this page of results.
     *
     * @param list<DigestInstance|DigestInstanceShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }

    /**
     * Always `list` for a paginated list response.
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
     * A cursor token for fetching the next page of results, or null when there are none.
     */
    public function withCursor(?string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * The path to fetch the next page of results, or null when there are none.
     */
    public function withNextURL(?string $nextURL): self
    {
        $self = clone $this;
        $self['nextURL'] = $nextURL;

        return $self;
    }

    /**
     * The path of the current request.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
