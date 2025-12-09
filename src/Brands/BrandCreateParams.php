<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Create a new brand.
 *
 * @see Courier\Services\BrandsService::create()
 *
 * @phpstan-type BrandCreateParamsShape = array{
 *   name: string,
 *   id?: string|null,
 *   settings?: null|BrandSettings|array{
 *     colors?: BrandColors|null,
 *     email?: BrandSettingsEmail|null,
 *     inapp?: BrandSettingsInApp|null,
 *   },
 *   snippets?: null|BrandSnippets|array{items?: list<BrandSnippet>|null},
 * }
 */
final class BrandCreateParams implements BaseModel
{
    /** @use SdkModel<BrandCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $name;

    #[Optional(nullable: true)]
    public ?string $id;

    #[Optional(nullable: true)]
    public ?BrandSettings $settings;

    #[Optional(nullable: true)]
    public ?BrandSnippets $snippets;

    /**
     * `new BrandCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BrandCreateParams::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BrandCreateParams)->withName(...)
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
        ?string $id = null,
        BrandSettings|array|null $settings = null,
        BrandSnippets|array|null $snippets = null,
    ): self {
        $obj = new self;

        $obj['name'] = $name;

        null !== $id && $obj['id'] = $id;
        null !== $settings && $obj['settings'] = $settings;
        null !== $snippets && $obj['snippets'] = $snippets;

        return $obj;
    }

    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    public function withID(?string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

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
