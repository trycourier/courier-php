<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Create a new brand. Requires `name` and `settings` (with at least `colors.primary` and `colors.secondary`).
 *
 * @see Courier\Services\BrandsService::create()
 *
 * @phpstan-import-type BrandSettingsShape from \Courier\Brands\BrandSettings
 * @phpstan-import-type BrandSnippetsShape from \Courier\Brands\BrandSnippets
 *
 * @phpstan-type BrandCreateParamsShape = array{
 *   name: string,
 *   settings: BrandSettings|BrandSettingsShape,
 *   id?: string|null,
 *   snippets?: null|BrandSnippets|BrandSnippetsShape,
 * }
 */
final class BrandCreateParams implements BaseModel
{
    /** @use SdkModel<BrandCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $name;

    #[Required]
    public BrandSettings $settings;

    #[Optional(nullable: true)]
    public ?string $id;

    #[Optional(nullable: true)]
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
     *
     * @param BrandSettings|BrandSettingsShape $settings
     * @param BrandSnippets|BrandSnippetsShape|null $snippets
     */
    public static function with(
        string $name,
        BrandSettings|array $settings,
        ?string $id = null,
        BrandSnippets|array|null $snippets = null,
    ): self {
        $self = new self;

        $self['name'] = $name;
        $self['settings'] = $settings;

        null !== $id && $self['id'] = $id;
        null !== $snippets && $self['snippets'] = $snippets;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * @param BrandSettings|BrandSettingsShape $settings
     */
    public function withSettings(BrandSettings|array $settings): self
    {
        $self = clone $this;
        $self['settings'] = $settings;

        return $self;
    }

    public function withID(?string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

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
