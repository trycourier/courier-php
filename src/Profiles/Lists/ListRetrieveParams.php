<?php

declare(strict_types=1);

namespace Courier\Profiles\Lists;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new ListRetrieveParams); // set properties as needed
 * $client->profiles.lists->retrieve(...$params->toArray());
 * ```
 * Returns the subscribed lists for a specified user.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->profiles.lists->retrieve(...$params->toArray());`
 *
 * @see Courier\Profiles\Lists->retrieve
 *
 * @phpstan-type list_retrieve_params = array{cursor?: string|null}
 */
final class ListRetrieveParams implements BaseModel
{
    /** @use SdkModel<list_retrieve_params> */
    use SdkModel;
    use SdkParams;

    /**
     * A unique identifier that allows for fetching the next set of message statuses.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $cursor;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $cursor = null): self
    {
        $obj = new self;

        null !== $cursor && $obj->cursor = $cursor;

        return $obj;
    }

    /**
     * A unique identifier that allows for fetching the next set of message statuses.
     */
    public function withCursor(?string $cursor): self
    {
        $obj = clone $this;
        $obj->cursor = $cursor;

        return $obj;
    }
}
