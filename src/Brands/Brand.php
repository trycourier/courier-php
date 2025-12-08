<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkResponse;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type BrandShape = array{
 *   id: string,
 *   created: int,
 *   name: string,
 *   updated: int,
 *   published?: int|null,
 *   settings?: BrandSettings|null,
 *   snippets?: BrandSnippets|null,
 *   version?: string|null,
 * }
 */
final class Brand implements BaseModel, ResponseConverter
{
    /** @use SdkModel<BrandShape> */
    use SdkModel;

    use SdkResponse;

    #[Api]
    public string $id;

    #[Api]
    public int $created;

    #[Api]
    public string $name;

    #[Api]
    public int $updated;

    #[Api(nullable: true, optional: true)]
    public ?int $published;

    #[Api(nullable: true, optional: true)]
    public ?BrandSettings $settings;

    #[Api(nullable: true, optional: true)]
    public ?BrandSnippets $snippets;

    #[Api(nullable: true, optional: true)]
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
     * @param BrandSettings|array{
     *   colors?: BrandColors|null,
     *   email?: BrandSettingsEmail|null,
     *   inapp?: BrandSettingsInApp|null,
     * }|null $settings
     * @param BrandSnippets|array{items?: list<BrandSnippet>|null}|null $snippets
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
        $obj = new self;

        $obj['id'] = $id;
        $obj['created'] = $created;
        $obj['name'] = $name;
        $obj['updated'] = $updated;

        null !== $published && $obj['published'] = $published;
        null !== $settings && $obj['settings'] = $settings;
        null !== $snippets && $obj['snippets'] = $snippets;
        null !== $version && $obj['version'] = $version;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    public function withCreated(int $created): self
    {
        $obj = clone $this;
        $obj['created'] = $created;

        return $obj;
    }

    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    public function withUpdated(int $updated): self
    {
        $obj = clone $this;
        $obj['updated'] = $updated;

        return $obj;
    }

    public function withPublished(?int $published): self
    {
        $obj = clone $this;
        $obj['published'] = $published;

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

    public function withVersion(?string $version): self
    {
        $obj = clone $this;
        $obj['version'] = $version;

        return $obj;
    }
}
