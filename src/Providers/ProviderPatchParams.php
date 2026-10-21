<?php

declare(strict_types=1);

namespace Courier\Providers;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Updates part of a provider's configuration and keeps every field you omit. Settings merge into the stored settings key by key, and a setting sent as null is removed.
 *
 * @see Courier\Services\ProvidersService::patch()
 *
 * @phpstan-type ProviderPatchParamsShape = array{
 *   alias?: string|null,
 *   provider?: string|null,
 *   settings?: array<string,mixed>|null,
 *   title?: string|null,
 * }
 */
final class ProviderPatchParams implements BaseModel
{
    /** @use SdkModel<ProviderPatchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Updated alias. Set to null to clear it.
     */
    #[Optional(nullable: true)]
    public ?string $alias;

    /**
     * The provider key identifying the type. Optional. When sent, it must match the stored provider, otherwise the request returns a 400.
     */
    #[Optional]
    public ?string $provider;

    /**
     * Provider-specific settings (snake_case keys) to merge into the stored settings, using JSON Merge Patch (RFC 7396). Each key you send replaces the stored value, a key set to null is removed, nested objects merge recursively, and arrays replace the stored value. Keys you omit keep their stored values. Set `rate_limit` to null to remove this configuration's send rate limit.
     *
     * @var array<string,mixed>|null $settings
     */
    #[Optional(map: 'mixed')]
    public ?array $settings;

    /**
     * Updated display title.
     */
    #[Optional]
    public ?string $title;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,mixed>|null $settings
     */
    public static function with(
        ?string $alias = null,
        ?string $provider = null,
        ?array $settings = null,
        ?string $title = null,
    ): self {
        $self = new self;

        null !== $alias && $self['alias'] = $alias;
        null !== $provider && $self['provider'] = $provider;
        null !== $settings && $self['settings'] = $settings;
        null !== $title && $self['title'] = $title;

        return $self;
    }

    /**
     * Updated alias. Set to null to clear it.
     */
    public function withAlias(?string $alias): self
    {
        $self = clone $this;
        $self['alias'] = $alias;

        return $self;
    }

    /**
     * The provider key identifying the type. Optional. When sent, it must match the stored provider, otherwise the request returns a 400.
     */
    public function withProvider(string $provider): self
    {
        $self = clone $this;
        $self['provider'] = $provider;

        return $self;
    }

    /**
     * Provider-specific settings (snake_case keys) to merge into the stored settings, using JSON Merge Patch (RFC 7396). Each key you send replaces the stored value, a key set to null is removed, nested objects merge recursively, and arrays replace the stored value. Keys you omit keep their stored values. Set `rate_limit` to null to remove this configuration's send rate limit.
     *
     * @param array<string,mixed> $settings
     */
    public function withSettings(array $settings): self
    {
        $self = clone $this;
        $self['settings'] = $settings;

        return $self;
    }

    /**
     * Updated display title.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }
}
