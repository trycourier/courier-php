<?php

declare(strict_types=1);

namespace Courier\Lists;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Returns all of the lists, with the ability to filter based on a pattern.
 *
 * @see Courier\Services\ListsService::list()
 *
 * @phpstan-type ListListParamsShape = array{
 *   cursor?: string|null, pattern?: string|null
 * }
 */
final class ListListParams implements BaseModel
{
    /** @use SdkModel<ListListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * A unique identifier that allows for fetching the next page of lists.
     */
    #[Optional(nullable: true)]
    public ?string $cursor;

    /**
     * "A pattern used to filter the list items returned. Pattern types supported: exact match on `list_id` or a pattern of one or more pattern parts. you may replace a part with either: `*` to match all parts in that position, or `**` to signify a wildcard `endsWith` pattern match.".
     */
    #[Optional(nullable: true)]
    public ?string $pattern;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $cursor = null,
        ?string $pattern = null
    ): self {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $pattern && $self['pattern'] = $pattern;

        return $self;
    }

    /**
     * A unique identifier that allows for fetching the next page of lists.
     */
    public function withCursor(?string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * "A pattern used to filter the list items returned. Pattern types supported: exact match on `list_id` or a pattern of one or more pattern parts. you may replace a part with either: `*` to match all parts in that position, or `**` to signify a wildcard `endsWith` pattern match.".
     */
    public function withPattern(?string $pattern): self
    {
        $self = clone $this;
        $self['pattern'] = $pattern;

        return $self;
    }
}
