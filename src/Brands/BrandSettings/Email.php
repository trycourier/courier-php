<?php

declare(strict_types=1);

namespace Courier\Brands\BrandSettings;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type email_alias = array{footer: mixed, header: mixed}
 */
final class Email implements BaseModel
{
    /** @use SdkModel<email_alias> */
    use SdkModel;

    #[Api]
    public mixed $footer;

    #[Api]
    public mixed $header;

    /**
     * `new Email()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Email::with(footer: ..., header: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Email)->withFooter(...)->withHeader(...)
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
    public static function with(mixed $footer, mixed $header): self
    {
        $obj = new self;

        $obj->footer = $footer;
        $obj->header = $header;

        return $obj;
    }

    public function withFooter(mixed $footer): self
    {
        $obj = clone $this;
        $obj->footer = $footer;

        return $obj;
    }

    public function withHeader(mixed $header): self
    {
        $obj = clone $this;
        $obj->header = $header;

        return $obj;
    }
}
