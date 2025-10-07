<?php

declare(strict_types=1);

namespace Courier\Brands\BrandSettings\Email;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type head_alias = array{inheritDefault: bool, content?: string|null}
 */
final class Head implements BaseModel
{
    /** @use SdkModel<head_alias> */
    use SdkModel;

    #[Api]
    public bool $inheritDefault;

    #[Api(nullable: true, optional: true)]
    public ?string $content;

    /**
     * `new Head()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Head::with(inheritDefault: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Head)->withInheritDefault(...)
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
        bool $inheritDefault,
        ?string $content = null
    ): self {
        $obj = new self;

        $obj->inheritDefault = $inheritDefault;

        null !== $content && $obj->content = $content;

        return $obj;
    }

    public function withInheritDefault(bool $inheritDefault): self
    {
        $obj = clone $this;
        $obj->inheritDefault = $inheritDefault;

        return $obj;
    }

    public function withContent(?string $content): self
    {
        $obj = clone $this;
        $obj->content = $content;

        return $obj;
    }
}
