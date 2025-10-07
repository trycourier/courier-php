<?php

declare(strict_types=1);

namespace Courier\Send\ElementalNode\UnionMember4;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type locale_alias = array{content: string}
 */
final class Locale implements BaseModel
{
    /** @use SdkModel<locale_alias> */
    use SdkModel;

    #[Api]
    public string $content;

    /**
     * `new Locale()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Locale::with(content: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Locale)->withContent(...)
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
    public static function with(string $content): self
    {
        $obj = new self;

        $obj->content = $content;

        return $obj;
    }

    public function withContent(string $content): self
    {
        $obj = clone $this;
        $obj->content = $content;

        return $obj;
    }
}
