<?php

declare(strict_types=1);

namespace Courier\Previews;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * The workspace's active device sets. Not paginated.
 *
 * @phpstan-import-type DeviceSetShape from \Courier\Previews\DeviceSet
 *
 * @phpstan-type DeviceSetListResponseShape = array{
 *   results: list<DeviceSet|DeviceSetShape>
 * }
 */
final class DeviceSetListResponse implements BaseModel
{
    /** @use SdkModel<DeviceSetListResponseShape> */
    use SdkModel;

    /** @var list<DeviceSet> $results */
    #[Required(list: DeviceSet::class)]
    public array $results;

    /**
     * `new DeviceSetListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DeviceSetListResponse::with(results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DeviceSetListResponse)->withResults(...)
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
     * @param list<DeviceSet|DeviceSetShape> $results
     */
    public static function with(array $results): self
    {
        $self = new self;

        $self['results'] = $results;

        return $self;
    }

    /**
     * @param list<DeviceSet|DeviceSetShape> $results
     */
    public function withResults(array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }
}
