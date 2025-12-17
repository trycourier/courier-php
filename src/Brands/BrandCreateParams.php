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
 * @phpstan-import-type BrandSettingsShape from \Courier\Brands\BrandSettings
 * @phpstan-import-type BrandSnippetsShape from \Courier\Brands\BrandSnippets
 *
 * @phpstan-type BrandCreateParamsShape = array{
 *   name: string,
 *   id?: string|null,
 *   settings?: BrandSettingsShape|null,
 *   snippets?: BrandSnippetsShape|null,
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
     * @param BrandSettingsShape|null $settings
     * @param BrandSnippetsShape|null $snippets
     */
    public static function with(
        string $name,
        ?string $id = null,
        BrandSettings|array|null $settings = null,
        BrandSnippets|array|null $snippets = null,
    ): self {
        $self = new self;

        $self['name'] = $name;

        null !== $id && $self['id'] = $id;
        null !== $settings && $self['settings'] = $settings;
        null !== $snippets && $self['snippets'] = $snippets;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withID(?string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * @param BrandSettingsShape|null $settings
     */
    public function withSettings(BrandSettings|array|null $settings): self
    {
        $self = clone $this;
        $self['settings'] = $settings;

        return $self;
    }

    /**
     * @param BrandSnippetsShape|null $snippets
     */
    public function withSnippets(BrandSnippets|array|null $snippets): self
    {
        $self = clone $this;
        $self['snippets'] = $snippets;

        return $self;
    }
}
