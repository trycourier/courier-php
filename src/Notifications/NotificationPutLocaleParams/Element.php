<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationPutLocaleParams;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type ElementShape = array{id: string}
 */
final class Element implements BaseModel
{
    /** @use SdkModel<ElementShape> */
    use SdkModel;

    /**
     * Target element ID.
     */
    #[Required]
    public string $id;

    /**
     * `new Element()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Element::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Element)->withID(...)
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
    public static function with(string $id): self
    {
        $self = new self;

        $self['id'] = $id;

        return $self;
    }

    /**
     * Target element ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }
}
