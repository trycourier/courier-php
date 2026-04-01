<?php

declare(strict_types=1);

namespace Courier\Providers\ProvidersCatalogEntry;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Describes a single configuration field in the provider catalog.
 *
 * @phpstan-type SettingShape = array{
 *   required: bool, type: string, values?: list<string>|null
 * }
 */
final class Setting implements BaseModel
{
    /** @use SdkModel<SettingShape> */
    use SdkModel;

    /**
     * Whether this field is required when configuring the provider.
     */
    #[Required]
    public bool $required;

    /**
     * The field's data type (e.g. "string", "boolean", "enum").
     */
    #[Required]
    public string $type;

    /**
     * Allowed values when `type` is "enum".
     *
     * @var list<string>|null $values
     */
    #[Optional(list: 'string')]
    public ?array $values;

    /**
     * `new Setting()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Setting::with(required: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Setting)->withRequired(...)->withType(...)
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
     * @param list<string>|null $values
     */
    public static function with(
        bool $required,
        string $type,
        ?array $values = null
    ): self {
        $self = new self;

        $self['required'] = $required;
        $self['type'] = $type;

        null !== $values && $self['values'] = $values;

        return $self;
    }

    /**
     * Whether this field is required when configuring the provider.
     */
    public function withRequired(bool $required): self
    {
        $self = clone $this;
        $self['required'] = $required;

        return $self;
    }

    /**
     * The field's data type (e.g. "string", "boolean", "enum").
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Allowed values when `type` is "enum".
     *
     * @param list<string> $values
     */
    public function withValues(array $values): self
    {
        $self = clone $this;
        $self['values'] = $values;

        return $self;
    }
}
