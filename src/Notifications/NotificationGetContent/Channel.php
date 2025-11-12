<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationGetContent;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\NotificationGetContent\Channel\Content;
use Courier\Notifications\NotificationGetContent\Channel\Locale;

/**
 * @phpstan-type ChannelShape = array{
 *   id: string,
 *   checksum?: string|null,
 *   content?: Content|null,
 *   locales?: array<string,Locale>|null,
 *   type?: string|null,
 * }
 */
final class Channel implements BaseModel
{
    /** @use SdkModel<ChannelShape> */
    use SdkModel;

    #[Api]
    public string $id;

    #[Api(nullable: true, optional: true)]
    public ?string $checksum;

    #[Api(nullable: true, optional: true)]
    public ?Content $content;

    /** @var array<string,Locale>|null $locales */
    #[Api(map: Locale::class, nullable: true, optional: true)]
    public ?array $locales;

    #[Api(nullable: true, optional: true)]
    public ?string $type;

    /**
     * `new Channel()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Channel::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Channel)->withID(...)
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
     * @param array<string,Locale>|null $locales
     */
    public static function with(
        string $id,
        ?string $checksum = null,
        ?Content $content = null,
        ?array $locales = null,
        ?string $type = null,
    ): self {
        $obj = new self;

        $obj->id = $id;

        null !== $checksum && $obj->checksum = $checksum;
        null !== $content && $obj->content = $content;
        null !== $locales && $obj->locales = $locales;
        null !== $type && $obj->type = $type;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    public function withChecksum(?string $checksum): self
    {
        $obj = clone $this;
        $obj->checksum = $checksum;

        return $obj;
    }

    public function withContent(?Content $content): self
    {
        $obj = clone $this;
        $obj->content = $content;

        return $obj;
    }

    /**
     * @param array<string,Locale>|null $locales
     */
    public function withLocales(?array $locales): self
    {
        $obj = clone $this;
        $obj->locales = $locales;

        return $obj;
    }

    public function withType(?string $type): self
    {
        $obj = clone $this;
        $obj->type = $type;

        return $obj;
    }
}
