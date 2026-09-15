<?php

declare(strict_types=1);

namespace Courier\WorkspacePreferences;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\WorkspacePreferences\TopicDigestCategory\Retain;

/**
 * How events collected under a category key are retained when a digest holds more than it will render.
 *
 * @phpstan-type TopicDigestCategoryShape = array{
 *   categoryKey: string,
 *   limit?: int|null,
 *   retain?: null|Retain|value-of<Retain>,
 *   sortKey?: string|null,
 * }
 */
final class TopicDigestCategory implements BaseModel
{
    /** @use SdkModel<TopicDigestCategoryShape> */
    use SdkModel;

    /**
     * The key that identifies the category within the digest.
     */
    #[Required('category_key')]
    public string $categoryKey;

    /**
     * How many collected events are carried into the rendered digest. Defaults to 10.
     *
     * Events beyond the limit are discarded, not held back for the next digest: the release consumes everything collected so far and only `limit` of them appear. `retain` decides which ones those are.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Which collected events survive the `limit`. `FIRST` and `LOWEST` keep the earliest or smallest; `LAST` and `HIGHEST` keep the latest or largest. Accepted case-insensitively, returned uppercase.
     *
     * @var value-of<Retain>|null $retain
     */
    #[Optional(enum: Retain::class)]
    public ?string $retain;

    /**
     * The data key used to rank events. Required when `retain` is `HIGHEST` or `LOWEST`.
     */
    #[Optional('sort_key')]
    public ?string $sortKey;

    /**
     * `new TopicDigestCategory()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TopicDigestCategory::with(categoryKey: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TopicDigestCategory)->withCategoryKey(...)
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
     * @param Retain|value-of<Retain>|null $retain
     */
    public static function with(
        string $categoryKey,
        ?int $limit = null,
        Retain|string|null $retain = null,
        ?string $sortKey = null,
    ): self {
        $self = new self;

        $self['categoryKey'] = $categoryKey;

        null !== $limit && $self['limit'] = $limit;
        null !== $retain && $self['retain'] = $retain;
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
     * How many collected events are carried into the rendered digest. Defaults to 10.
     *
     * Events beyond the limit are discarded, not held back for the next digest: the release consumes everything collected so far and only `limit` of them appear. `retain` decides which ones those are.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Which collected events survive the `limit`. `FIRST` and `LOWEST` keep the earliest or smallest; `LAST` and `HIGHEST` keep the latest or largest. Accepted case-insensitively, returned uppercase.
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
     * The data key used to rank events. Required when `retain` is `HIGHEST` or `LOWEST`.
     */
    public function withSortKey(string $sortKey): self
    {
        $self = clone $this;
        $self['sortKey'] = $sortKey;

        return $self;
    }
}
