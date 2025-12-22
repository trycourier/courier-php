<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type IntercomRecipientShape from \Courier\IntercomRecipient
 *
 * @phpstan-type IntercomShape = array{
 *   from: string, to: IntercomRecipient|IntercomRecipientShape
 * }
 */
final class Intercom implements BaseModel
{
    /** @use SdkModel<IntercomShape> */
    use SdkModel;

    #[Required]
    public string $from;

    #[Required]
    public IntercomRecipient $to;

    /**
     * `new Intercom()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Intercom::with(from: ..., to: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Intercom)->withFrom(...)->withTo(...)
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
     * @param IntercomRecipient|IntercomRecipientShape $to
     */
    public static function with(string $from, IntercomRecipient|array $to): self
    {
        $self = new self;

        $self['from'] = $from;
        $self['to'] = $to;

        return $self;
    }

    public function withFrom(string $from): self
    {
        $self = clone $this;
        $self['from'] = $from;

        return $self;
    }

    /**
     * @param IntercomRecipient|IntercomRecipientShape $to
     */
    public function withTo(IntercomRecipient|array $to): self
    {
        $self = clone $this;
        $self['to'] = $to;

        return $self;
    }
}
