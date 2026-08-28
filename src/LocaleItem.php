<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type LocaleItemShape = array{content: string}
 */
final class LocaleItem implements BaseModel
{
    /** @use SdkModel<LocaleItemShape> */
    use SdkModel;

    #[Required]
    public string $content;

    /**
     * `new LocaleItem()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LocaleItem::with(content: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LocaleItem)->withContent(...)
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
    public static function with(string $content): self
    {
        $self = new self;

        $self['content'] = $content;

        return $self;
    }

    public function withContent(string $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }
}
