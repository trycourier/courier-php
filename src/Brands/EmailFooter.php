<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type email_footer = array{content?: mixed, inheritDefault?: bool|null}
 */
final class EmailFooter implements BaseModel
{
    /** @use SdkModel<email_footer> */
    use SdkModel;

    #[Api(optional: true)]
    public mixed $content;

    #[Api(nullable: true, optional: true)]
    public ?bool $inheritDefault;

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
        mixed $content = null,
        ?bool $inheritDefault = null
    ): self {
        $obj = new self;

        null !== $content && $obj->content = $content;
        null !== $inheritDefault && $obj->inheritDefault = $inheritDefault;

        return $obj;
    }

    public function withContent(mixed $content): self
    {
        $obj = clone $this;
        $obj->content = $content;

        return $obj;
    }

    public function withInheritDefault(?bool $inheritDefault): self
    {
        $obj = clone $this;
        $obj->inheritDefault = $inheritDefault;

        return $obj;
    }
}
