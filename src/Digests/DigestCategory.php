<?php

declare(strict_types=1);

namespace Courier\Digests;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Digests\DigestCategory\Retain;

/**
 * @phpstan-type DigestCategoryShape = array{
 *   categoryKey: string, retain: Retain|value-of<Retain>, sortKey?: string|null
 * }
 */
final class DigestCategory implements BaseModel
{
    /** @use SdkModel<DigestCategoryShape> */
    use SdkModel;

    /**
     * The key that identifies the category within the digest.
     */
    #[Required('category_key')]
    public string $categoryKey;

    /**
     * Which events to keep when the number of events exceeds the retention limit for the category.
     *
     * @var value-of<Retain> $retain
     */
    #[Required(enum: Retain::class)]
    public string $retain;

    /**
     * The data key used to order events when `retain` is `highest` or `lowest`.
     */
    #[Optional('sort_key')]
    public ?string $sortKey;

    /**
     * `new DigestCategory()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DigestCategory::with(categoryKey: ..., retain: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DigestCategory)->withCategoryKey(...)->withRetain(...)
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
     * @param Retain|value-of<Retain> $retain
     */
    public static function with(
        string $categoryKey,
        Retain|string $retain,
        ?string $sortKey = null
    ): self {
        $self = new self;

        $self['categoryKey'] = $categoryKey;
        $self['retain'] = $retain;

        null !== $sortKey && $self['sortKey'] = $sortKey;

        return $self;
    }

    /**
     * The key that identifies the category within the digest.
     */
    public function withCategoryKey(string $categoryKey): self
    {
        $self = clone $this;
        $self['categoryKey'] = $categoryKey;

        return $self;
    }

    /**
     * Which events to keep when the number of events exceeds the retention limit for the category.
     *
     * @param Retain|value-of<Retain> $retain
     */
    public function withRetain(Retain|string $retain): self
    {
        $self = clone $this;
        $self['retain'] = $retain;

        return $self;
    }

    /**
     * The data key used to order events when `retain` is `highest` or `lowest`.
     */
    public function withSortKey(string $sortKey): self
    {
        $self = clone $this;
        $self['sortKey'] = $sortKey;

        return $self;
    }
}
