<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type BrandSnippetShape = array{name: string, value: string}
 */
final class BrandSnippet implements BaseModel
{
    /** @use SdkModel<BrandSnippetShape> */
    use SdkModel;

    #[Required]
    public string $name;

    #[Required]
    public string $value;

    /**
     * `new BrandSnippet()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BrandSnippet::with(name: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BrandSnippet)->withName(...)->withValue(...)
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
    public static function with(string $name, string $value): self
    {
        $self = new self;

        $self['name'] = $name;
        $self['value'] = $value;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withValue(string $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
