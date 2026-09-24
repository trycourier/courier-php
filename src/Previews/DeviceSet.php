<?php

declare(strict_types=1);

namespace Courier\Previews;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * A named, reusable list of preview devices.
 *
 * @phpstan-type DeviceSetShape = array{
 *   id: string,
 *   createdAt: string,
 *   deviceIDs: list<string>,
 *   name: string,
 *   updatedAt: string,
 *   archivedAt?: string|null,
 * }
 */
final class DeviceSet implements BaseModel
{
    /** @use SdkModel<DeviceSetShape> */
    use SdkModel;

    /**
     * Unique identifier for the device set.
     */
    #[Required]
    public string $id;

    /**
     * ISO-8601 timestamp of when the set was created.
     */
    #[Required('created_at')]
    public string $createdAt;

    /**
     * The devices in this set, by `PreviewDevice.id`.
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
     * ISO-8601 timestamp of when the set was last written.
     */
    #[Required('updated_at')]
    public string $updatedAt;

    /**
     * ISO-8601 timestamp of when the set was archived. Present only on the archive response, which is the one place the state is observable.
     */
    #[Optional('archived_at')]
    public ?string $archivedAt;

    /**
     * `new DeviceSet()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DeviceSet::with(
     *   id: ..., createdAt: ..., deviceIDs: ..., name: ..., updatedAt: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DeviceSet)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withDeviceIDs(...)
     *   ->withName(...)
     *   ->withUpdatedAt(...)
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
    public static function with(
        string $id,
        string $createdAt,
        array $deviceIDs,
        string $name,
        string $updatedAt,
        ?string $archivedAt = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['deviceIDs'] = $deviceIDs;
        $self['name'] = $name;
        $self['updatedAt'] = $updatedAt;

        null !== $archivedAt && $self['archivedAt'] = $archivedAt;

        return $self;
    }

    /**
     * Unique identifier for the device set.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * ISO-8601 timestamp of when the set was created.
     */
    public function withCreatedAt(string $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The devices in this set, by `PreviewDevice.id`.
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

    /**
     * ISO-8601 timestamp of when the set was last written.
     */
    public function withUpdatedAt(string $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * ISO-8601 timestamp of when the set was archived. Present only on the archive response, which is the one place the state is observable.
     */
    public function withArchivedAt(string $archivedAt): self
    {
        $self = clone $this;
        $self['archivedAt'] = $archivedAt;

        return $self;
    }
}
