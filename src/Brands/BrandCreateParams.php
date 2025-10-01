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
 * $params = (new BrandCreateParams); // set properties as needed
 * $client->brands->create(...$params->toArray());
 * ```
 * Create a new brand.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->brands->create(...$params->toArray());`
 *
 * @see Courier\Brands->create
 *
 * @phpstan-type brand_create_params = array{
 *   name: string,
 *   settings: BrandSettings,
 *   id?: string|null,
 *   snippets?: BrandSnippets|null,
 * }
 */
final class BrandCreateParams implements BaseModel
{
    /** @use SdkModel<brand_create_params> */
    use SdkModel;
    use SdkParams;

    /**
     * The name of the brand.
     */
    #[Api]
    public string $name;

    #[Api]
    public BrandSettings $settings;

    #[Api(nullable: true, optional: true)]
    public ?string $id;

    #[Api(nullable: true, optional: true)]
    public ?BrandSnippets $snippets;

    /**
     * `new BrandCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BrandCreateParams::with(name: ..., settings: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BrandCreateParams)->withName(...)->withSettings(...)
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
        BrandSettings $settings,
        ?string $id = null,
        ?BrandSnippets $snippets = null,
    ): self {
        $obj = new self;

        $obj->name = $name;
        $obj->settings = $settings;

        null !== $id && $obj->id = $id;
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

    public function withSettings(BrandSettings $settings): self
    {
        $obj = clone $this;
        $obj->settings = $settings;

        return $obj;
    }

    public function withID(?string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    public function withSnippets(?BrandSnippets $snippets): self
    {
        $obj = clone $this;
        $obj->snippets = $snippets;

        return $obj;
    }
}
