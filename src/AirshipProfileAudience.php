<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type AirshipProfileAudienceShape = array{namedUser: string}
 */
final class AirshipProfileAudience implements BaseModel
{
    /** @use SdkModel<AirshipProfileAudienceShape> */
    use SdkModel;

    #[Required('named_user')]
    public string $namedUser;

    /**
     * `new AirshipProfileAudience()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AirshipProfileAudience::with(namedUser: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AirshipProfileAudience)->withNamedUser(...)
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
    public static function with(string $namedUser): self
    {
        $self = new self;

        $self['namedUser'] = $namedUser;

        return $self;
    }

    public function withNamedUser(string $namedUser): self
    {
        $self = clone $this;
        $self['namedUser'] = $namedUser;

        return $self;
    }
}
