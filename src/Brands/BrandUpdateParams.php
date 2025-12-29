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
 * @phpstan-import-type BrandSettingsShape from \Courier\Brands\BrandSettings
 * @phpstan-import-type BrandSnippetsShape from \Courier\Brands\BrandSnippets
 *
 * @phpstan-type BrandUpdateParamsShape = array{
 *   name: string,
 *   settings?: null|BrandSettings|BrandSettingsShape,
 *   snippets?: null|BrandSnippets|BrandSnippetsShape,
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
     * @param BrandSettings|BrandSettingsShape|null $settings
     * @param BrandSnippets|BrandSnippetsShape|null $snippets
     */
    public static function with(
        string $name,
        BrandSettings|array|null $settings = null,
        BrandSnippets|array|null $snippets = null,
    ): self {
        $self = new self;

        $self['name'] = $name;

        null !== $settings && $self['settings'] = $settings;
        null !== $snippets && $self['snippets'] = $snippets;

        return $self;
    }

    /**
     * The name of the brand.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * @param BrandSettings|BrandSettingsShape|null $settings
     */
    public function withSettings(BrandSettings|array|null $settings): self
    {
        $self = clone $this;
        $self['settings'] = $settings;

        return $self;
    }

    /**
     * @param BrandSnippets|BrandSnippetsShape|null $snippets
     */
    public function withSnippets(BrandSnippets|array|null $snippets): self
    {
        $self = clone $this;
        $self['snippets'] = $snippets;

        return $self;
    }
}
