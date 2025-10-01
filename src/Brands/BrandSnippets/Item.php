<?php

declare(strict_types=1);

namespace Courier\Brands\BrandSnippets;

use Courier\Brands\BrandSnippets\Item\Format;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type item_alias = array{
 *   format: value-of<Format>, name: string, value: string
 * }
 */
final class Item implements BaseModel
{
    /** @use SdkModel<item_alias> */
    use SdkModel;

    /** @var value-of<Format> $format */
    #[Api(enum: Format::class)]
    public string $format;

    #[Api]
    public string $name;

    #[Api]
    public string $value;

    /**
     * `new Item()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Item::with(format: ..., name: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Item)->withFormat(...)->withName(...)->withValue(...)
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
     * @param Format|value-of<Format> $format
     */
    public static function with(
        Format|string $format,
        string $name,
        string $value
    ): self {
        $obj = new self;

        $obj->format = $format instanceof Format ? $format->value : $format;
        $obj->name = $name;
        $obj->value = $value;

        return $obj;
    }

    /**
     * @param Format|value-of<Format> $format
     */
    public function withFormat(Format|string $format): self
    {
        $obj = clone $this;
        $obj->format = $format instanceof Format ? $format->value : $format;

        return $obj;
    }

    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    public function withValue(string $value): self
    {
        $obj = clone $this;
        $obj->value = $value;

        return $obj;
    }
}
