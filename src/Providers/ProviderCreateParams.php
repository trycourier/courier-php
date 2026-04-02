<?php

declare(strict_types=1);

namespace Courier\Providers;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Create a new provider configuration. The `provider` field must be a known Courier provider key (see catalog).
 *
 * @see Courier\Services\ProvidersService::create()
 *
 * @phpstan-type ProviderCreateParamsShape = array{
 *   provider: string,
 *   alias?: string|null,
 *   settings?: array<string,mixed>|null,
 *   title?: string|null,
 * }
 */
final class ProviderCreateParams implements BaseModel
{
    /** @use SdkModel<ProviderCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The provider key identifying the type (e.g. "sendgrid", "twilio"). Must be a known Courier provider — see the catalog endpoint for valid keys.
     */
    #[Required]
    public string $provider;

    /**
     * Optional alias for this configuration.
     */
    #[Optional]
    public ?string $alias;

    /**
     * Provider-specific settings (snake_case keys). Defaults to an empty object when omitted. Use the catalog endpoint to discover required fields for a given provider — omitting a required field returns a 400 validation error.
     *
     * @var array<string,mixed>|null $settings
     */
    #[Optional(map: 'mixed')]
    public ?array $settings;

    /**
     * Optional display title. Omit to use "Default Configuration".
     */
    #[Optional]
    public ?string $title;

    /**
     * `new ProviderCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProviderCreateParams::with(provider: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProviderCreateParams)->withProvider(...)
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
     * The provider key identifying the type (e.g. "sendgrid", "twilio"). Must be a known Courier provider — see the catalog endpoint for valid keys.
     */
    public function withProvider(string $provider): self
    {
        $self = clone $this;
        $self['provider'] = $provider;

        return $self;
    }

    /**
     * Optional alias for this configuration.
     */
    public function withAlias(string $alias): self
    {
        $self = clone $this;
        $self['alias'] = $alias;

        return $self;
    }

    /**
     * Provider-specific settings (snake_case keys). Defaults to an empty object when omitted. Use the catalog endpoint to discover required fields for a given provider — omitting a required field returns a 400 validation error.
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
     * Optional display title. Omit to use "Default Configuration".
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }
}
