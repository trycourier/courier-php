<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Publish the current draft as a new version. Optionally rollback to a prior version by passing `{ version: 'vN' }`.
 *
 * @see Courier\Services\JourneysService::publish()
 *
 * @phpstan-type JourneyPublishParamsShape = array{version?: string|null}
 */
final class JourneyPublishParams implements BaseModel
{
    /** @use SdkModel<JourneyPublishParamsShape> */
    use SdkModel;
    use SdkParams;

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

    public function withVersion(string $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }
}
