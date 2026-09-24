<?php

declare(strict_types=1);

namespace Courier\Previews;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * The full catalog of renderable devices. Not paginated.
 *
 * @phpstan-import-type PreviewDeviceShape from \Courier\Previews\PreviewDevice
 *
 * @phpstan-type PreviewDeviceListResponseShape = array{
 *   results: list<PreviewDevice|PreviewDeviceShape>
 * }
 */
final class PreviewDeviceListResponse implements BaseModel
{
    /** @use SdkModel<PreviewDeviceListResponseShape> */
    use SdkModel;

    /** @var list<PreviewDevice> $results */
    #[Required(list: PreviewDevice::class)]
    public array $results;

    /**
     * `new PreviewDeviceListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreviewDeviceListResponse::with(results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreviewDeviceListResponse)->withResults(...)
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
     * @param list<PreviewDevice|PreviewDeviceShape> $results
     */
    public static function with(array $results): self
    {
        $self = new self;

        $self['results'] = $results;

        return $self;
    }

    /**
     * @param list<PreviewDevice|PreviewDeviceShape> $results
     */
    public function withResults(array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }
}
