<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Brands\BrandSettings\Colors;
use Courier\Brands\BrandSettings\Email;
use Courier\Brands\BrandSettings\Inapp;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type brand_settings = array{
 *   colors?: Colors|null, email?: Email|null, inapp?: Inapp|null
 * }
 */
final class BrandSettings implements BaseModel
{
    /** @use SdkModel<brand_settings> */
    use SdkModel;

    #[Api(nullable: true, optional: true)]
    public ?Colors $colors;

    #[Api(nullable: true, optional: true)]
    public ?Email $email;

    #[Api(nullable: true, optional: true)]
    public ?Inapp $inapp;

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
        ?Colors $colors = null,
        ?Email $email = null,
        ?Inapp $inapp = null
    ): self {
        $obj = new self;

        null !== $colors && $obj->colors = $colors;
        null !== $email && $obj->email = $email;
        null !== $inapp && $obj->inapp = $inapp;

        return $obj;
    }

    public function withColors(?Colors $colors): self
    {
        $obj = clone $this;
        $obj->colors = $colors;

        return $obj;
    }

    public function withEmail(?Email $email): self
    {
        $obj = clone $this;
        $obj->email = $email;

        return $obj;
    }

    public function withInapp(?Inapp $inapp): self
    {
        $obj = clone $this;
        $obj->inapp = $inapp;

        return $obj;
    }
}
