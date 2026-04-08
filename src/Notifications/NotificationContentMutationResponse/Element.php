<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationContentMutationResponse;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type ElementShape = array{id: string, checksum: string}
 */
final class Element implements BaseModel
{
    /** @use SdkModel<ElementShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required]
    public string $checksum;

    /**
     * `new Element()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Element::with(id: ..., checksum: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Element)->withID(...)->withChecksum(...)
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
    public static function with(string $id, string $checksum): self
    {
        $self = new self;

        $self['id'] = $id;
        $self['checksum'] = $checksum;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withChecksum(string $checksum): self
    {
        $self = clone $this;
        $self['checksum'] = $checksum;

        return $self;
    }
}
