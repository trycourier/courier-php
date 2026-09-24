<?php

declare(strict_types=1);

namespace Courier\Previews;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Previews\PreviewDevice\Category;
use Courier\Previews\PreviewDevice\Theme;

/**
 * One mail app on one platform, operating system and theme that a preview can be rendered on. Reference data, identical for every workspace. Every field is always present; `platform` and `platform_version` are null where they do not apply.
 *
 * @phpstan-type PreviewDeviceShape = array{
 *   id: string,
 *   app: string,
 *   category: Category|value-of<Category>,
 *   name: string,
 *   os: string,
 *   osVersion: string,
 *   platform: string|null,
 *   platformVersion: string|null,
 *   theme: Theme|value-of<Theme>,
 * }
 */
final class PreviewDevice implements BaseModel
{
    /** @use SdkModel<PreviewDeviceShape> */
    use SdkModel;

    /**
     * The device's identifier, used in `device_ids` when creating a device set or a run.
     */
    #[Required]
    public string $id;

    /**
     * The mail app. For webmail it is the service (`outlook_com`, `gmail_com`); for mobile the app (`apple_mail`, `gmail`); for desktop the app together with the version it is sold under (`outlook_2019`, `outlook_microsoft_365`, `apple_mail_16`), because that version is what separates one desktop Outlook from another.
     */
    #[Required]
    public string $app;

    /**
     * Where the app runs.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * Display name. Render it as-is rather than parsing it. It is also what separates the two 120-dpi Outlook renders from their 100% siblings, which are otherwise identical field for field.
     */
    #[Required]
    public string $name;

    /**
     * The operating system.
     */
    #[Required]
    public string $os;

    /**
     * The operating system's version. Always set.
     */
    #[Required('os_version')]
    public string $osVersion;

    /**
     * What the app runs on — the browser for webmail (`chrome`, `edge`, `firefox`), the phone for mobile (`iphone`, `pixel`). Null for desktop, where the app runs on nothing but the OS.
     */
    #[Required]
    public ?string $platform;

    /**
     * Which one of the platform — the phone model for mobile (`15_pro_max`, `10`). Null for webmail, which always renders in the current browser, and for desktop.
     */
    #[Required('platform_version')]
    public ?string $platformVersion;

    /**
     * Whether the email is rendered in light or dark mode.
     *
     * @var value-of<Theme> $theme
     */
    #[Required(enum: Theme::class)]
    public string $theme;

    /**
     * `new PreviewDevice()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreviewDevice::with(
     *   id: ...,
     *   app: ...,
     *   category: ...,
     *   name: ...,
     *   os: ...,
     *   osVersion: ...,
     *   platform: ...,
     *   platformVersion: ...,
     *   theme: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreviewDevice)
     *   ->withID(...)
     *   ->withApp(...)
     *   ->withCategory(...)
     *   ->withName(...)
     *   ->withOs(...)
     *   ->withOsVersion(...)
     *   ->withPlatform(...)
     *   ->withPlatformVersion(...)
     *   ->withTheme(...)
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
     * @param Category|value-of<Category> $category
     * @param Theme|value-of<Theme> $theme
     */
    public static function with(
        string $id,
        string $app,
        Category|string $category,
        string $name,
        string $os,
        string $osVersion,
        ?string $platform,
        ?string $platformVersion,
        Theme|string $theme,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['app'] = $app;
        $self['category'] = $category;
        $self['name'] = $name;
        $self['os'] = $os;
        $self['osVersion'] = $osVersion;
        $self['platform'] = $platform;
        $self['platformVersion'] = $platformVersion;
        $self['theme'] = $theme;

        return $self;
    }

    /**
     * The device's identifier, used in `device_ids` when creating a device set or a run.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The mail app. For webmail it is the service (`outlook_com`, `gmail_com`); for mobile the app (`apple_mail`, `gmail`); for desktop the app together with the version it is sold under (`outlook_2019`, `outlook_microsoft_365`, `apple_mail_16`), because that version is what separates one desktop Outlook from another.
     */
    public function withApp(string $app): self
    {
        $self = clone $this;
        $self['app'] = $app;

        return $self;
    }

    /**
     * Where the app runs.
     *
     * @param Category|value-of<Category> $category
     */
    public function withCategory(Category|string $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * Display name. Render it as-is rather than parsing it. It is also what separates the two 120-dpi Outlook renders from their 100% siblings, which are otherwise identical field for field.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The operating system.
     */
    public function withOs(string $os): self
    {
        $self = clone $this;
        $self['os'] = $os;

        return $self;
    }

    /**
     * The operating system's version. Always set.
     */
    public function withOsVersion(string $osVersion): self
    {
        $self = clone $this;
        $self['osVersion'] = $osVersion;

        return $self;
    }

    /**
     * What the app runs on — the browser for webmail (`chrome`, `edge`, `firefox`), the phone for mobile (`iphone`, `pixel`). Null for desktop, where the app runs on nothing but the OS.
     */
    public function withPlatform(?string $platform): self
    {
        $self = clone $this;
        $self['platform'] = $platform;

        return $self;
    }

    /**
     * Which one of the platform — the phone model for mobile (`15_pro_max`, `10`). Null for webmail, which always renders in the current browser, and for desktop.
     */
    public function withPlatformVersion(?string $platformVersion): self
    {
        $self = clone $this;
        $self['platformVersion'] = $platformVersion;

        return $self;
    }

    /**
     * Whether the email is rendered in light or dark mode.
     *
     * @param Theme|value-of<Theme> $theme
     */
    public function withTheme(Theme|string $theme): self
    {
        $self = clone $this;
        $self['theme'] = $theme;

        return $self;
    }
}
