<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Elemental content response for V2 templates. Contains versioned elements with content checksums.
 *
 * @phpstan-type NotificationContentGetResponseShape = array{
 *   elements: list<mixed>, version: string
 * }
 */
final class NotificationContentGetResponse implements BaseModel
{
    /** @use SdkModel<NotificationContentGetResponseShape> */
    use SdkModel;

    /** @var list<mixed> $elements */
    #[Required(list: ElementWithChecksums::class)]
    public array $elements;

    /**
     * Content version identifier.
     */
    #[Required]
    public string $version;

    /**
     * `new NotificationContentGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationContentGetResponse::with(elements: ..., version: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationContentGetResponse)->withElements(...)->withVersion(...)
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
     * @param list<mixed> $elements
     */
    public static function with(array $elements, string $version): self
    {
        $self = new self;

        $self['elements'] = $elements;
        $self['version'] = $version;

        return $self;
    }

    /**
     * @param list<mixed> $elements
     */
    public function withElements(array $elements): self
    {
        $self = clone $this;
        $self['elements'] = $elements;

        return $self;
    }

    /**
     * Content version identifier.
     */
    public function withVersion(string $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }
}
