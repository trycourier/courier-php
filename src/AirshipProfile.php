<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type AirshipProfileAudienceShape from \Courier\AirshipProfileAudience
 *
 * @phpstan-type AirshipProfileShape = array{
 *   audience: AirshipProfileAudience|AirshipProfileAudienceShape,
 *   deviceTypes: list<string>,
 * }
 */
final class AirshipProfile implements BaseModel
{
    /** @use SdkModel<AirshipProfileShape> */
    use SdkModel;

    #[Required]
    public AirshipProfileAudience $audience;

    /** @var list<string> $deviceTypes */
    #[Required('device_types', list: 'string')]
    public array $deviceTypes;

    /**
     * `new AirshipProfile()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AirshipProfile::with(audience: ..., deviceTypes: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AirshipProfile)->withAudience(...)->withDeviceTypes(...)
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
     * @param AirshipProfileAudience|AirshipProfileAudienceShape $audience
     * @param list<string> $deviceTypes
     */
    public static function with(
        AirshipProfileAudience|array $audience,
        array $deviceTypes
    ): self {
        $self = new self;

        $self['audience'] = $audience;
        $self['deviceTypes'] = $deviceTypes;

        return $self;
    }

    /**
     * @param AirshipProfileAudience|AirshipProfileAudienceShape $audience
     */
    public function withAudience(AirshipProfileAudience|array $audience): self
    {
        $self = clone $this;
        $self['audience'] = $audience;

        return $self;
    }

    /**
     * @param list<string> $deviceTypes
     */
    public function withDeviceTypes(array $deviceTypes): self
    {
        $self = clone $this;
        $self['deviceTypes'] = $deviceTypes;

        return $self;
    }
}
