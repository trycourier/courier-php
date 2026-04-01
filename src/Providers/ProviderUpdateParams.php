<?php

declare(strict_types=1);

namespace Courier\Providers;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Update an existing provider configuration. The `provider` key is required. All other fields are optional — omitted fields are cleared from the stored configuration (this is a full replacement, not a partial merge).
 *
 * @see Courier\Services\ProvidersService::update()
 *
 * @phpstan-type ProviderUpdateParamsShape = array{
 *   provider: string,
 *   alias?: string|null,
 *   settings?: array<string,mixed>|null,
 *   title?: string|null,
 * }
 */
final class ProviderUpdateParams implements BaseModel
{
    /** @use SdkModel<ProviderUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The provider key identifying the type.
     */
    #[Required]
    public string $provider;

    /**
     * Updated alias. Omit to clear.
     */
    #[Optional]
    public ?string $alias;

    /**
     * Provider-specific settings (snake_case keys). Replaces the full settings object — omitted settings fields are removed. Use the catalog endpoint to check required fields.
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

    /**
     * `new ProviderUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProviderUpdateParams::with(provider: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProviderUpdateParams)->withProvider(...)
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
     * @param array<string,mixed>|null $settings
     */
    public static function with(
        string $provider,
        ?string $alias = null,
        ?array $settings = null,
        ?string $title = null,
    ): self {
        $self = new self;

        $self['provider'] = $provider;

        null !== $alias && $self['alias'] = $alias;
        null !== $settings && $self['settings'] = $settings;
        null !== $title && $self['title'] = $title;

        return $self;
    }

    /**
     * The provider key identifying the type.
     */
    public function withProvider(string $provider): self
    {
        $self = clone $this;
        $self['provider'] = $provider;

        return $self;
    }

    /**
     * Updated alias. Omit to clear.
     */
    public function withAlias(string $alias): self
    {
        $self = clone $this;
        $self['alias'] = $alias;

        return $self;
    }

    /**
     * Provider-specific settings (snake_case keys). Replaces the full settings object — omitted settings fields are removed. Use the catalog endpoint to check required fields.
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
