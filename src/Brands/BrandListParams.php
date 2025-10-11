<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new BrandListParams); // set properties as needed
 * $client->brands->list(...$params->toArray());
 * ```
 * Get the list of brands.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->brands->list(...$params->toArray());`
 *
 * @see Courier\Brands->list
 *
 * @phpstan-type brand_list_params = array{cursor?: string|null}
 */
final class BrandListParams implements BaseModel
{
    /** @use SdkModel<brand_list_params> */
    use SdkModel;
    use SdkParams;

    /**
     * A unique identifier that allows for fetching the next set of brands.
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
     * A unique identifier that allows for fetching the next set of brands.
     */
    public function withCursor(?string $cursor): self
    {
        $obj = clone $this;
        $obj->cursor = $cursor;

        return $obj;
    }
}
