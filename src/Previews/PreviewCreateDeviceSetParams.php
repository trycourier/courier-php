<?php

declare(strict_types=1);

namespace Courier\Previews;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Create a named, reusable set of preview devices. Every id must be one listed by `GET /previews/devices`; any other is a 422.
 *
 * @see Courier\Services\PreviewsService::createDeviceSet()
 *
 * @phpstan-type PreviewCreateDeviceSetParamsShape = array{
 *   deviceIDs: list<string>, name: string
 * }
 */
final class PreviewCreateDeviceSetParams implements BaseModel
{
    /** @use SdkModel<PreviewCreateDeviceSetParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The devices the set contains, by `PreviewDevice.id`. At least one is required.
     *
     * @var list<string> $deviceIDs
     */
    #[Required('device_ids', list: 'string')]
    public array $deviceIDs;

    /**
     * Human-readable name.
     */
    #[Required]
    public string $name;

    /**
     * `new PreviewCreateDeviceSetParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreviewCreateDeviceSetParams::with(deviceIDs: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreviewCreateDeviceSetParams)->withDeviceIDs(...)->withName(...)
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
     * @param list<string> $deviceIDs
     */
    public static function with(array $deviceIDs, string $name): self
    {
        $self = new self;

        $self['deviceIDs'] = $deviceIDs;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The devices the set contains, by `PreviewDevice.id`. At least one is required.
     *
     * @param list<string> $deviceIDs
     */
    public function withDeviceIDs(array $deviceIDs): self
    {
        $self = clone $this;
        $self['deviceIDs'] = $deviceIDs;

        return $self;
    }

    /**
     * Human-readable name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
