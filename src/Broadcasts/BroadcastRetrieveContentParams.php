<?php

declare(strict_types=1);

namespace Courier\Broadcasts;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Retrieve the broadcast's content — the elemental content of its private notification template. Defaults to the working draft, since broadcast content is authored as a draft until the broadcast is sent.
 *
 * @see Courier\Services\BroadcastsService::retrieveContent()
 *
 * @phpstan-type BroadcastRetrieveContentParamsShape = array{version?: string|null}
 */
final class BroadcastRetrieveContentParams implements BaseModel
{
    /** @use SdkModel<BroadcastRetrieveContentParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Accepts `draft`, `published`, or a version string (e.g. `v001`). Defaults to `draft`.
     */
    #[Optional]
    public ?string $version;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $version = null): self
    {
        $self = new self;

        null !== $version && $self['version'] = $version;

        return $self;
    }

    /**
     * Accepts `draft`, `published`, or a version string (e.g. `v001`). Defaults to `draft`.
     */
    public function withVersion(string $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }
}
