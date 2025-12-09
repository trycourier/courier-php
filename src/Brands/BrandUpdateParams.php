<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Replace an existing brand with the supplied values.
 *
 * @see Courier\Services\BrandsService::update()
 *
 * @phpstan-type BrandUpdateParamsShape = array{
 *   name: string,
 *   settings?: null|BrandSettings|array{
 *     colors?: BrandColors|null,
 *     email?: BrandSettingsEmail|null,
 *     inapp?: BrandSettingsInApp|null,
 *   },
 *   snippets?: null|BrandSnippets|array{items?: list<BrandSnippet>|null},
 * }
 */
final class BrandUpdateParams implements BaseModel
{
    /** @use SdkModel<BrandUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The name of the brand.
     */
    #[Required]
    public string $name;

    #[Optional(nullable: true)]
    public ?BrandSettings $settings;

    #[Optional(nullable: true)]
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
     *
     * @param BrandSettings|array{
     *   colors?: BrandColors|null,
     *   email?: BrandSettingsEmail|null,
     *   inapp?: BrandSettingsInApp|null,
     * }|null $settings
     * @param BrandSnippets|array{items?: list<BrandSnippet>|null}|null $snippets
     */
    public static function with(
        string $name,
        BrandSettings|array|null $settings = null,
        BrandSnippets|array|null $snippets = null,
    ): self {
        $obj = new self;

        $obj['name'] = $name;

        null !== $settings && $obj['settings'] = $settings;
        null !== $snippets && $obj['snippets'] = $snippets;

        return $obj;
    }

    /**
     * The name of the brand.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    /**
     * @param BrandSettings|array{
     *   colors?: BrandColors|null,
     *   email?: BrandSettingsEmail|null,
     *   inapp?: BrandSettingsInApp|null,
     * }|null $settings
     */
    public function withSettings(BrandSettings|array|null $settings): self
    {
        $obj = clone $this;
        $obj['settings'] = $settings;

        return $obj;
    }

    /**
     * @param BrandSnippets|array{items?: list<BrandSnippet>|null}|null $snippets
     */
    public function withSnippets(BrandSnippets|array|null $snippets): self
    {
        $obj = clone $this;
        $obj['snippets'] = $snippets;

        return $obj;
    }
}
