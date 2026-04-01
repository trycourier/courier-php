<?php

declare(strict_types=1);

namespace Courier\Providers;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * List configured provider integrations for the current workspace. Supports cursor-based pagination.
 *
 * @see Courier\Services\ProvidersService::list()
 *
 * @phpstan-type ProviderListParamsShape = array{cursor?: string|null}
 */
final class ProviderListParams implements BaseModel
{
    /** @use SdkModel<ProviderListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Opaque cursor for fetching the next page.
     */
    #[Optional]
    public ?string $cursor;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $cursor = null): self
    {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * Opaque cursor for fetching the next page.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }
}
