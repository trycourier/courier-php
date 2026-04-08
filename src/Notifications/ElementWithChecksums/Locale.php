<?php

declare(strict_types=1);

namespace Courier\Notifications\ElementWithChecksums;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type LocaleShape = array{checksum: string}
 */
final class Locale implements BaseModel
{
    /** @use SdkModel<LocaleShape> */
    use SdkModel;

    #[Required]
    public string $checksum;

    /**
     * `new Locale()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Locale::with(checksum: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Locale)->withChecksum(...)
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
    public static function with(string $checksum): self
    {
        $self = new self;

        $self['checksum'] = $checksum;

        return $self;
    }

    public function withChecksum(string $checksum): self
    {
        $self = clone $this;
        $self['checksum'] = $checksum;

        return $self;
    }
}
