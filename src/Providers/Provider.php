<?php

declare(strict_types=1);

namespace Courier\Providers;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * A configured provider in the workspace.
 *
 * @phpstan-type ProviderShape = array{
 *   id: string,
 *   created: int,
 *   provider: string,
 *   settings: array<string,mixed>,
 *   title: string,
 *   alias?: string|null,
 *   updated?: int|null,
 * }
 */
final class Provider implements BaseModel
{
    /** @use SdkModel<ProviderShape> */
    use SdkModel;

    /**
     * A unique identifier for the provider configuration.
     */
    #[Required]
    public string $id;

    /**
     * Unix timestamp (ms) of when the provider was created.
     */
    #[Required]
    public int $created;

    /**
     * The provider key (e.g. "sendgrid", "twilio", "slack").
     */
    #[Required]
    public string $provider;

    /**
     * Provider-specific settings (snake_case keys on the wire).
     *
     * @var array<string,mixed> $settings
     */
    #[Required(map: 'mixed')]
    public array $settings;

    /**
     * Display title. Defaults to "Default Configuration" when not explicitly set.
     */
    #[Required]
    public string $title;

    /**
     * Optional alias for this configuration.
     */
    #[Optional]
    public ?string $alias;

    /**
     * Unix timestamp (ms) of when the provider was last updated.
     */
    #[Optional(nullable: true)]
    public ?int $updated;

    /**
     * `new Provider()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Provider::with(id: ..., created: ..., provider: ..., settings: ..., title: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Provider)
     *   ->withID(...)
     *   ->withCreated(...)
     *   ->withProvider(...)
     *   ->withSettings(...)
     *   ->withTitle(...)
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
     * @param array<string,mixed> $settings
     */
    public static function with(
        string $id,
        int $created,
        string $provider,
        array $settings,
        string $title,
        ?string $alias = null,
        ?int $updated = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['created'] = $created;
        $self['provider'] = $provider;
        $self['settings'] = $settings;
        $self['title'] = $title;

        null !== $alias && $self['alias'] = $alias;
        null !== $updated && $self['updated'] = $updated;

        return $self;
    }

    /**
     * A unique identifier for the provider configuration.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Unix timestamp (ms) of when the provider was created.
     */
    public function withCreated(int $created): self
    {
        $self = clone $this;
        $self['created'] = $created;

        return $self;
    }

    /**
     * The provider key (e.g. "sendgrid", "twilio", "slack").
     */
    public function withProvider(string $provider): self
    {
        $self = clone $this;
        $self['provider'] = $provider;

        return $self;
    }

    /**
     * Provider-specific settings (snake_case keys on the wire).
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
     * Display title. Defaults to "Default Configuration" when not explicitly set.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

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
     * Unix timestamp (ms) of when the provider was last updated.
     */
    public function withUpdated(?int $updated): self
    {
        $self = clone $this;
        $self['updated'] = $updated;

        return $self;
    }
}
