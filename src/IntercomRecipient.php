<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type IntercomRecipientShape = array{id: string}
 */
final class IntercomRecipient implements BaseModel
{
    /** @use SdkModel<IntercomRecipientShape> */
    use SdkModel;

    #[Required]
    public string $id;

    /**
     * `new IntercomRecipient()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * IntercomRecipient::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new IntercomRecipient)->withID(...)
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

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }
}
