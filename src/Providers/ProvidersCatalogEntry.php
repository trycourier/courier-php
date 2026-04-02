<?php

declare(strict_types=1);

namespace Courier\Providers;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Providers\ProvidersCatalogEntry\Setting;

/**
 * A provider type from the catalog. Contains the key, display name, description, and a `settings` object describing configuration schema fields.
 *
 * @phpstan-import-type SettingShape from \Courier\Providers\ProvidersCatalogEntry\Setting
 *
 * @phpstan-type ProvidersCatalogEntryShape = array{
 *   channel: string,
 *   description: string,
 *   name: string,
 *   provider: string,
 *   settings: array<string,Setting|SettingShape>,
 * }
 */
final class ProvidersCatalogEntry implements BaseModel
{
    /** @use SdkModel<ProvidersCatalogEntryShape> */
    use SdkModel;

    /**
     * Courier taxonomy channel (e.g. email, push, sms, direct_message, inbox, webhook).
     */
    #[Required]
    public string $channel;

    /**
     * Short description of the provider.
     */
    #[Required]
    public string $description;

    /**
     * Human-readable display name.
     */
    #[Required]
    public string $name;

    /**
     * The provider key (e.g. "sendgrid", "twilio").
     */
    #[Required]
    public string $provider;

    /**
     * Map of setting field names (snake_case) to their schema descriptors. Each descriptor has `type` and `required`. Empty when the provider has no configurable schema.
     *
     * @var array<string,Setting> $settings
     */
    #[Required(map: Setting::class)]
    public array $settings;

    /**
     * `new ProvidersCatalogEntry()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProvidersCatalogEntry::with(
     *   channel: ..., description: ..., name: ..., provider: ..., settings: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProvidersCatalogEntry)
     *   ->withChannel(...)
     *   ->withDescription(...)
     *   ->withName(...)
     *   ->withProvider(...)
     *   ->withSettings(...)
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
     * @param array<string,Setting|SettingShape> $settings
     */
    public static function with(
        string $channel,
        string $description,
        string $name,
        string $provider,
        array $settings,
    ): self {
        $self = new self;

        $self['channel'] = $channel;
        $self['description'] = $description;
        $self['name'] = $name;
        $self['provider'] = $provider;
        $self['settings'] = $settings;

        return $self;
    }

    /**
     * Courier taxonomy channel (e.g. email, push, sms, direct_message, inbox, webhook).
     */
    public function withChannel(string $channel): self
    {
        $self = clone $this;
        $self['channel'] = $channel;

        return $self;
    }

    /**
     * Short description of the provider.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Human-readable display name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The provider key (e.g. "sendgrid", "twilio").
     */
    public function withProvider(string $provider): self
    {
        $self = clone $this;
        $self['provider'] = $provider;

        return $self;
    }

    /**
     * Map of setting field names (snake_case) to their schema descriptors. Each descriptor has `type` and `required`. Empty when the provider has no configurable schema.
     *
     * @param array<string,Setting|SettingShape> $settings
     */
    public function withSettings(array $settings): self
    {
        $self = clone $this;
        $self['settings'] = $settings;

        return $self;
    }
}
