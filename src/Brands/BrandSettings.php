<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type BrandColorsShape from \Courier\Brands\BrandColors
 * @phpstan-import-type BrandSettingsEmailShape from \Courier\Brands\BrandSettingsEmail
 * @phpstan-import-type BrandSettingsInAppShape from \Courier\Brands\BrandSettingsInApp
 *
 * @phpstan-type BrandSettingsShape = array{
 *   colors?: null|BrandColors|BrandColorsShape,
 *   email?: null|BrandSettingsEmail|BrandSettingsEmailShape,
 *   inapp?: null|BrandSettingsInApp|BrandSettingsInAppShape,
 * }
 */
final class BrandSettings implements BaseModel
{
    /** @use SdkModel<BrandSettingsShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?BrandColors $colors;

    #[Optional(nullable: true)]
    public ?BrandSettingsEmail $email;

    #[Optional(nullable: true)]
    public ?BrandSettingsInApp $inapp;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param BrandColorsShape|null $colors
     * @param BrandSettingsEmailShape|null $email
     * @param BrandSettingsInAppShape|null $inapp
     */
    public static function with(
        BrandColors|array|null $colors = null,
        BrandSettingsEmail|array|null $email = null,
        BrandSettingsInApp|array|null $inapp = null,
    ): self {
        $self = new self;

        null !== $colors && $self['colors'] = $colors;
        null !== $email && $self['email'] = $email;
        null !== $inapp && $self['inapp'] = $inapp;

        return $self;
    }

    /**
     * @param BrandColorsShape|null $colors
     */
    public function withColors(BrandColors|array|null $colors): self
    {
        $self = clone $this;
        $self['colors'] = $colors;

        return $self;
    }

    /**
     * @param BrandSettingsEmailShape|null $email
     */
    public function withEmail(BrandSettingsEmail|array|null $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * @param BrandSettingsInAppShape|null $inapp
     */
    public function withInapp(BrandSettingsInApp|array|null $inapp): self
    {
        $self = clone $this;
        $self['inapp'] = $inapp;

        return $self;
    }
}
