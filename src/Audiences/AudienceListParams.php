<?php

declare(strict_types=1);

namespace Courier\Audiences;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new AudienceListParams); // set properties as needed
 * $client->audiences->list(...$params->toArray());
 * ```
 * Get the audiences associated with the authorization token.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->audiences->list(...$params->toArray());`
 *
 * @see Courier\Audiences->list
 *
 * @phpstan-type audience_list_params = array{cursor?: string|null}
 */
final class AudienceListParams implements BaseModel
{
    /** @use SdkModel<audience_list_params> */
    use SdkModel;
    use SdkParams;

    /**
     * A unique identifier that allows for fetching the next set of audiences.
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
     * A unique identifier that allows for fetching the next set of audiences.
     */
    public function withCursor(?string $cursor): self
    {
        $obj = clone $this;
        $obj->cursor = $cursor;

        return $obj;
    }
}
