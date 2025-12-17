<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type BrandSettingsShape from \Courier\Brands\BrandSettings
 * @phpstan-import-type BrandSnippetsShape from \Courier\Brands\BrandSnippets
 *
 * @phpstan-type BrandShape = array{
 *   id: string,
 *   created: int,
 *   name: string,
 *   updated: int,
 *   published?: int|null,
 *   settings?: null|BrandSettings|BrandSettingsShape,
 *   snippets?: null|BrandSnippets|BrandSnippetsShape,
 *   version?: string|null,
 * }
 */
final class Brand implements BaseModel
{
    /** @use SdkModel<BrandShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required]
    public int $created;

    #[Required]
    public string $name;

    #[Required]
    public int $updated;

    #[Optional(nullable: true)]
    public ?int $published;

    #[Optional(nullable: true)]
    public ?BrandSettings $settings;

    #[Optional(nullable: true)]
    public ?BrandSnippets $snippets;

    #[Optional(nullable: true)]
    public ?string $version;

    /**
     * `new Brand()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Brand::with(id: ..., created: ..., name: ..., updated: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Brand)->withID(...)->withCreated(...)->withName(...)->withUpdated(...)
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
        string $id,
        int $created,
        string $name,
        int $updated,
        ?int $published = null,
        BrandSettings|array|null $settings = null,
        BrandSnippets|array|null $snippets = null,
        ?string $version = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['created'] = $created;
        $self['name'] = $name;
        $self['updated'] = $updated;

        null !== $published && $self['published'] = $published;
        null !== $settings && $self['settings'] = $settings;
        null !== $snippets && $self['snippets'] = $snippets;
        null !== $version && $self['version'] = $version;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withCreated(int $created): self
    {
        $self = clone $this;
        $self['created'] = $created;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withUpdated(int $updated): self
    {
        $self = clone $this;
        $self['updated'] = $updated;

        return $self;
    }

    public function withPublished(?int $published): self
    {
        $self = clone $this;
        $self['published'] = $published;

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

    public function withVersion(?string $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }
}
