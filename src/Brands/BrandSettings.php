<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type BrandSettingsShape = array{
 *   colors?: BrandColors|null,
 *   email?: BrandSettingsEmail|null,
 *   inapp?: BrandSettingsInApp|null,
 * }
 */
final class BrandSettings implements BaseModel
{
    /** @use SdkModel<BrandSettingsShape> */
    use SdkModel;

    #[Api(nullable: true, optional: true)]
    public ?BrandColors $colors;

    #[Api(nullable: true, optional: true)]
    public ?BrandSettingsEmail $email;

    #[Api(nullable: true, optional: true)]
    public ?BrandSettingsInApp $inapp;

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
        ?BrandColors $colors = null,
        ?BrandSettingsEmail $email = null,
        ?BrandSettingsInApp $inapp = null,
    ): self {
        $obj = new self;

        null !== $colors && $obj->colors = $colors;
        null !== $email && $obj->email = $email;
        null !== $inapp && $obj->inapp = $inapp;

        return $obj;
    }

    public function withColors(?BrandColors $colors): self
    {
        $obj = clone $this;
        $obj->colors = $colors;

        return $obj;
    }

    public function withEmail(?BrandSettingsEmail $email): self
    {
        $obj = clone $this;
        $obj->email = $email;

        return $obj;
    }

    public function withInapp(?BrandSettingsInApp $inapp): self
    {
        $obj = clone $this;
        $obj->inapp = $inapp;

        return $obj;
    }
}
