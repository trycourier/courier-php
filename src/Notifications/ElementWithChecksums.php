<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\ElementWithChecksums\Locale;

/**
 * An element with its content checksum and optional nested elements and locale checksums.
 *
 * @phpstan-import-type LocaleShape from \Courier\Notifications\ElementWithChecksums\Locale
 *
 * @phpstan-type ElementWithChecksumsShape = array{
 *   checksum: string,
 *   type: string,
 *   id?: string|null,
 *   elements?: list<mixed>|null,
 *   locales?: array<string,Locale|LocaleShape>|null,
 * }
 */
final class ElementWithChecksums implements BaseModel
{
    /** @use SdkModel<ElementWithChecksumsShape> */
    use SdkModel;

    /**
     * MD5 hash of translatable content.
     */
    #[Required]
    public string $checksum;

    /**
     * Element type (text, meta, action, etc.).
     */
    #[Required]
    public string $type;

    #[Optional]
    public ?string $id;

    /**
     * Nested child elements (for group-type elements).
     *
     * @var list<mixed>|null $elements
     */
    #[Optional(list: ElementWithChecksums::class)]
    public ?array $elements;

    /**
     * Locale-specific content with checksums.
     *
     * @var array<string,Locale>|null $locales
     */
    #[Optional(map: Locale::class)]
    public ?array $locales;

    /**
     * `new ElementWithChecksums()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ElementWithChecksums::with(checksum: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ElementWithChecksums)->withChecksum(...)->withType(...)
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
     * @param list<mixed>|null $elements
     * @param array<string,Locale|LocaleShape>|null $locales
     */
    public static function with(
        string $checksum,
        string $type,
        ?string $id = null,
        ?array $elements = null,
        ?array $locales = null,
    ): self {
        $self = new self;

        $self['checksum'] = $checksum;
        $self['type'] = $type;

        null !== $id && $self['id'] = $id;
        null !== $elements && $self['elements'] = $elements;
        null !== $locales && $self['locales'] = $locales;

        return $self;
    }

    /**
     * MD5 hash of translatable content.
     */
    public function withChecksum(string $checksum): self
    {
        $self = clone $this;
        $self['checksum'] = $checksum;

        return $self;
    }

    /**
     * Element type (text, meta, action, etc.).
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Nested child elements (for group-type elements).
     *
     * @param list<mixed> $elements
     */
    public function withElements(array $elements): self
    {
        $self = clone $this;
        $self['elements'] = $elements;

        return $self;
    }

    /**
     * Locale-specific content with checksums.
     *
     * @param array<string,Locale|LocaleShape> $locales
     */
    public function withLocales(array $locales): self
    {
        $self = clone $this;
        $self['locales'] = $locales;

        return $self;
    }
}
