<?php

declare(strict_types=1);

namespace Courier\Lists;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new ListListParams); // set properties as needed
 * $client->lists->list(...$params->toArray());
 * ```
 * Returns all of the lists, with the ability to filter based on a pattern.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->lists->list(...$params->toArray());`
 *
 * @see Courier\Lists->list
 *
 * @phpstan-type list_list_params = array{
 *   cursor?: string|null, pattern?: string|null
 * }
 */
final class ListListParams implements BaseModel
{
    /** @use SdkModel<list_list_params> */
    use SdkModel;
    use SdkParams;

    /**
     * A unique identifier that allows for fetching the next page of lists.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $cursor;

    /**
     * "A pattern used to filter the list items returned. Pattern types supported: exact match on `list_id` or a pattern of one or more pattern parts. you may replace a part with either: `*` to match all parts in that position, or `**` to signify a wildcard `endsWith` pattern match.".
     */
    #[Api(nullable: true, optional: true)]
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
        $obj = new self;

        null !== $cursor && $obj->cursor = $cursor;
        null !== $pattern && $obj->pattern = $pattern;

        return $obj;
    }

    /**
     * A unique identifier that allows for fetching the next page of lists.
     */
    public function withCursor(?string $cursor): self
    {
        $obj = clone $this;
        $obj->cursor = $cursor;

        return $obj;
    }

    /**
     * "A pattern used to filter the list items returned. Pattern types supported: exact match on `list_id` or a pattern of one or more pattern parts. you may replace a part with either: `*` to match all parts in that position, or `**` to signify a wildcard `endsWith` pattern match.".
     */
    public function withPattern(?string $pattern): self
    {
        $obj = clone $this;
        $obj->pattern = $pattern;

        return $obj;
    }
}
