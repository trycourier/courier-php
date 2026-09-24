<?php

declare(strict_types=1);

namespace Courier\Previews;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Request body for creating or replacing a device set. A full replace, not a patch — both fields are always written.
 *
 * @phpstan-type CreateDeviceSetRequestShape = array{
 *   deviceIDs: list<string>, name: string
 * }
 */
final class CreateDeviceSetRequest implements BaseModel
{
    /** @use SdkModel<CreateDeviceSetRequestShape> */
    use SdkModel;

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
     * `new CreateDeviceSetRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreateDeviceSetRequest::with(deviceIDs: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreateDeviceSetRequest)->withDeviceIDs(...)->withName(...)
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
