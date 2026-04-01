<?php

declare(strict_types=1);

namespace Courier\Providers\Catalog;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Returns the catalog of available provider types with their display names, descriptions, and configuration schema fields (snake_case, with `type` and `required`). Providers with no configurable schema return only `provider`, `name`, and `description`.
 *
 * @see Courier\Services\Providers\CatalogService::list()
 *
 * @phpstan-type CatalogListParamsShape = array{
 *   channel?: string|null, keys?: string|null, name?: string|null
 * }
 */
final class CatalogListParams implements BaseModel
{
    /** @use SdkModel<CatalogListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Exact match (case-insensitive) against the provider channel taxonomy (e.g. `email`, `sms`, `push`).
     */
    #[Optional]
    public ?string $channel;

    /**
     * Comma-separated provider keys to filter by (e.g. `sendgrid,twilio`).
     */
    #[Optional]
    public ?string $keys;

    /**
     * Case-insensitive substring match against the provider display name.
     */
    #[Optional]
    public ?string $name;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $channel = null,
        ?string $keys = null,
        ?string $name = null
    ): self {
        $self = new self;

        null !== $channel && $self['channel'] = $channel;
        null !== $keys && $self['keys'] = $keys;
        null !== $name && $self['name'] = $name;

        return $self;
    }

    /**
     * Exact match (case-insensitive) against the provider channel taxonomy (e.g. `email`, `sms`, `push`).
     */
    public function withChannel(string $channel): self
    {
        $self = clone $this;
        $self['channel'] = $channel;

        return $self;
    }

    /**
     * Comma-separated provider keys to filter by (e.g. `sendgrid,twilio`).
     */
    public function withKeys(string $keys): self
    {
        $self = clone $this;
        $self['keys'] = $keys;

        return $self;
    }

    /**
     * Case-insensitive substring match against the provider display name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
