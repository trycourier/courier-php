<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\BrandSettings;
use Courier\BrandSnippets;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new BrandUpdateParams); // set properties as needed
 * $client->brands->update(...$params->toArray());
 * ```
 * Replace an existing brand with the supplied values.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->brands->update(...$params->toArray());`
 *
 * @see Courier\Brands->update
 *
 * @phpstan-type brand_update_params = array{
 *   name: string, settings?: BrandSettings|null, snippets?: BrandSnippets|null
 * }
 */
final class BrandUpdateParams implements BaseModel
{
    /** @use SdkModel<brand_update_params> */
    use SdkModel;
    use SdkParams;

    /**
     * The name of the brand.
     */
    #[Api]
    public string $name;

    #[Api(nullable: true, optional: true)]
    public ?BrandSettings $settings;

    #[Api(nullable: true, optional: true)]
    public ?BrandSnippets $snippets;

    /**
     * `new BrandUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BrandUpdateParams::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BrandUpdateParams)->withName(...)
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
     */
    public static function with(
        string $name,
        ?BrandSettings $settings = null,
        ?BrandSnippets $snippets = null,
    ): self {
        $obj = new self;

        $obj->name = $name;

        null !== $settings && $obj->settings = $settings;
        null !== $snippets && $obj->snippets = $snippets;

        return $obj;
    }

    /**
     * The name of the brand.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    public function withSettings(?BrandSettings $settings): self
    {
        $obj = clone $this;
        $obj->settings = $settings;

        return $obj;
    }

    public function withSnippets(?BrandSnippets $snippets): self
    {
        $obj = clone $this;
        $obj->snippets = $snippets;

        return $obj;
    }
}
